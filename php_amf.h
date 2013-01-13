/**
 * amf encoding and decoding of AMF and AMF3 data
 * 
 * @license http://opensource.org/licenses/php.php PHP License Version 3
 * @copyright (c) 2006-2007 Emanuele Ruffaldi emanuele.ruffaldi@gmail.com
 * @author Emanuele Ruffaldi
 *
 */
#ifndef PHP_AMF_H
#define PHP_AMF_H 1

#define PHP_AMF_VERSION "0.9.2-dev"
#define PHP_AMF_WORLD_EXTNAME "amf"

PHP_FUNCTION(amf_encode);
PHP_FUNCTION(amf_decode);
PHP_FUNCTION(amf_join_test);
PHP_FUNCTION(amf_sb_new);
PHP_FUNCTION(amf_sb_append);
PHP_FUNCTION(amf_sb_append_move);
PHP_FUNCTION(amf_sb_length);
PHP_FUNCTION(amf_sb_as_string);
PHP_FUNCTION(amf_sb_write);
PHP_FUNCTION(amf_sb_echo);
PHP_FUNCTION(amf_sb_memusage);

extern zend_module_entry amf_module_entry;
#define phpext_amf_ptr &amf_module_entry

#endif
