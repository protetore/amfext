
dnl $Id: config.m4,v 1.2 2007/04/20 20:20:08 sankazim Exp $
dnl

AC_DEFUN([PHP_AMF_ADD_SOURCES], [
  PHP_AMF_SOURCES="$PHP_AMF_SOURCES $1"
])

AC_DEFUN([PHP_AMF_ADD_BASE_SOURCES], [
  PHP_AMF_BASE_SOURCES="$PHP_AMF_BASE_SOURCES $1"
])

AC_DEFUN([PHP_AMF_ADD_BUILD_DIR], [
  PHP_AMF_EXTRA_BUILD_DIRS="$PHP_AMF_EXTRA_BUILD_DIRS $1"
])

AC_DEFUN([PHP_AMF_ADD_INCLUDE], [
  PHP_AMF_EXTRA_INCLUDES="$PHP_AMF_EXTRA_INCLUDES $1"
])

AC_DEFUN([PHP_AMF_ADD_CONFIG_HEADER], [
  PHP_AMF_EXTRA_CONFIG_HEADERS="$PHP_AMF_EXTRA_CONFIG_HEADERS $1"
])

AC_DEFUN([PHP_AMF_ADD_CFLAG], [
  PHP_AMF_CFLAGS="$PHP_AMF_CFLAGS $1"
])

AC_DEFUN([PHP_AMF_EXTENSION], [
  PHP_NEW_EXTENSION(amf, $PHP_AMF_SOURCES, $ext_shared,, $PHP_AMF_CFLAGS)
  PHP_SUBST(AMF_SHARED_LIBADD)

  for dir in $PHP_AMF_EXTRA_BUILD_DIRS; do
    PHP_ADD_BUILD_DIR([$ext_builddir/$dir], 1)
  done
  
  for dir in $PHP_AMF_EXTRA_INCLUDES; do
    PHP_ADD_INCLUDE([$ext_srcdir/$dir])
    PHP_ADD_INCLUDE([$ext_builddir/$dir])
  done

  if test "$ext_shared" = "no"; then
    PHP_ADD_SOURCES(PHP_EXT_DIR(amf), $PHP_AMF_BASE_SOURCES,$PHP_AMF_CFLAGS)
    out="php_config.h"
  else
    PHP_ADD_SOURCES_X(PHP_EXT_DIR(amf),$PHP_AMF_BASE_SOURCES,$PHP_AMF_CFLAGS,shared_objects_amf,yes)
    if test -f "$ext_builddir/config.h.in"; then
      out="$abs_builddir/config.h"
    else
      out="php_config.h"
    fi
  fi
  
  for cfg in $PHP_AMF_EXTRA_CONFIG_HEADERS; do
    cat > $ext_builddir/$cfg <<EOF
#include "$out"
EOF
  done
])

dnl
dnl Main config
dnl

PHP_ARG_WITH(amf, whether to enable AMF Serialization support,
[  --with-amf       Enable AMF Object Serialization support])

if test "$PHP_AMF" != "no"; then  
  AC_DEFINE([HAVE_AMF],1,[whether to have AMF Object Serialization support])
  AC_HEADER_STDC

  PHP_AMF_ADD_BASE_SOURCES([amf.c])

  dnl amf_c is required
  PHP_AMF_SETUP_AMF_CHECKER
  PHP_AMF_EXTENSION
  dnl PHP_INSTALL_HEADERS([ext/amf], [amf_c])
fi

# vim600: sts=2 sw=2 et
