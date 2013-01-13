<?php
/**
 * amfphp encoding and decoding of AMF and AMF3 data
 * 
 * @license http://opensource.org/licenses/php.php PHP License Version 3
 * @copyright (c) 2006-2007 Emanuele Ruffaldi emanuele.ruffaldi@gmail.com
 * @author Emanuele Ruffaldi
 *
 * This is an import file for constants defined by AMFPHP C
 */

/// AMFPHP native flags for encode and decode
define("AMF_AMF3",1);   // encoding: use AMF3,   decoding: AMF3 was found
define("AMF_BIG_ENDIAN",2);  // encoding/decoding: machine is bigendian
define("AMF_ASSOCIATIVE_DECODE",4); // decoding: treat anonymous objects as associative arrays
define("AMF_POST_DECODE",8); // decoding: invoke post decoding callback on every object handled as object
define("AMF_AS_STRING_BUILDER",16); // decoding: invoke post decoding callback on every object handled as object
define("AMF_TRANSLATE_CHARSET",32); // encoding/decoding: translate every string
define("AMF_TRANSLATE_CHARSET_NOASCII",32|64); // skips US-ASCII strings for translation, only in decoding

/// AMFPHP native event types for decoding callback
/// The decoding callback has two parameters. The first is the type of event from the following and the others is the argument of the event
///    
/// AMFE_MAP event: invoked when a typed object is received it allows to map an AMF className into a PHP classname or array. The argument is the name of the class and the callback should return the resulting
///  container as an object or array. The callback is not invoked if the object has an empty classname
/// pseudocode:
///         $r = mycallback(AMFE_MAP, $classname)
///         if(not $r is ARRAY and not $r is OBJECT)
///             $r = new $classname()
/// AMFE_POST_OBJECT event: invoked after the decoding of an Object only if the AMF_POST_DECODE flag has been set. The argument is the value of the object that can be modified by the callback
///          $r = mycallback(AMFE_POST_DECODE, $r)
/// AMFE_POST_XML event: invoked after the decoding of an XML structure. The argument is a string
/// AMFE_MAP_EXTERNALIZABLE: invoked for mapping a class that is externalizable. $arg is the classname and the callback should return the resulting
///  container as an object or array
/// AMFE_POST_BYTEARRAY: invoked for mapping a ByteArray object, otherwise it is represented as a string
/// AMFE_TRANSLATE_CHARSET: invoked for mapping a string into another string using charset
define("AMFE_MAP",1);
define("AMFE_POST_OBJECT",2);
define("AMFE_POST_XML",3);
define("AMFE_MAP_EXTERNALIZABLE",4);
define("AMFE_POST_BYTEARRAY",5);
define("AMFE_TRANSLATE_CHARSET",6);

define("AMFR_NONE",0); 
define("AMFR_ARRAY",1); 
define("AMFR_ARRAY_COLLECTION",2); 

/// AMFPHP callback return types 
/// The encoding callback has two parameters and returns a single value or an array with up to 3 elements:
///      (value, type, classname) = mycallback(value, classname)
/// Value is the new value to be encoded
/// Type is the type of the value from the following types, if it is not specified it is AMFC_TYPEDOBJECT
/// Classname is the name of the class to be used
///
define("AMFC_RAW", 0); // treat the returned string as raw AMF data
define("AMFC_XML", 1); // treat the returned string as XML data
define("AMFC_OBJECT",2); // treat the returned value as an anonymous object
define("AMFC_TYPEDOBJECT",3); // treat the returned value as an object with type. The class is specified by the third parameter
define("AMFC_ANY",4); // interpret again the returned value
define("AMFC_ARRAY",5); // treat the returned value as an array
define("AMFC_NONE",6); // returns undefined
define("AMFC_BYTEARRAY",7); // returns a ByteArray but only in AMF3

?>