<?php
/**
 * amf encoding and decoding of AMF and AMF3 data
 * 
 * @license http://opensource.org/licenses/php.php PHP License Version 3
 * @copyright (c) 2006-2007 Emanuele Ruffaldi emanuele.ruffaldi@gmail.com
 * @author Emanuele Ruffaldi
 *
	This PHP file contains the documentation for the AMF extension 
	that can be  processed using phpDocumentor http://www.phpdoc.org/
 */
 
/*! \mainpage AMF Extension 
 *
 * Welcome to the Documentation of the C extension for Encoding and Decoding AMF (Flash) messages.
 *
 *
 *
 * Details on encoding are in \htmlonly <a href="../encoding.txt")>encoding.txt</a> \endhtmlonly
 *
 * \see amf_decode and amf_encode
 *
 */

/**#@+
 * Flags for encoding and decoding
 */
/**
  * encoding: use AMF3 encoding
  * decoding: it is returned by the decoder to mark the presence of AMF3 data
  */
define("AMF_AMF3",1);   
/**
  * encoding/decoding: the machine is big endian
  * The endianess can be checked using: pack("d", 1) == "\0\0\0\0\0\0\360\77"
  */
define("AMF_BIG_ENDIAN",2);  
/**
 * Decoding: objects with anonymous class should be treated as associative arrays
 */
define("AMF_ASSOCIATIVE_DECODE",4); 
/**
 * Decoding: invoke post decoding callback on every generated object
 */
define("AMF_POST_DECODE",8); 
/**
 * Encoding: returns an AMF String Builder resource instead of a String
 */
define("AMF_AS_STRING_BUILDER",16); 

/**
 * Encoding/Decoding translate every string to and from UTF8
 */
define("AMF_CHARSET_TRANSLATE",32); 

/**
 * Encoding/Decoding translate every string to and from UTF8, only applied to non ASCII strings
 *
 * Be careful with this flag. In particular it is SAFE to use this flag in decoding because UTF8 strings with only
 * characters in 7-bit can be mapped safely to a target encoding. Except maybe the Yen issue with Shift_JIS
 *
 * The encoding from Shift_JIS or Big 5 or in general other double byte encoding is not safe because they have both
 * low and high bytes.
 */
define("AMF_CHARSET_TRANSLATE_NOASCII",32|64); 

/**#@-*/

/**#@+
 * Types of data returned by the amf_encode_callback defined by the user
 */
/**
 * Treat the returned string as raw AMF data 
 */
define("AMFC_RAW", 0); 
/**
 * Treat the returned string as XML data
 */
define("AMFC_XML", 1); 
/**
 * Treat the returned value as object
 */
define("AMFC_OBJECT",2);
/**
 * Treat the returned value as a typed object. The classname can be returned by the callback
 */
define("AMFC_TYPEDOBJECT",3); 
/**
 * Analyzes again the returned value. 
 */
define("AMFC_ANY",4); 
/**
 * Treat the returned value as an array. 
 */
define("AMFC_ARRAY",5); 
/**
 * An undefined value
 */ 
define("AMFC_NONE",6); 
/**
 * A ByteArray, used only for AMF3. In AMF0 it is equivalent to a string
 */ 
define("AMFC_BYTEARRAY",7); 
/**#@-*/

/**#@+
 * Types of RecordSet for __amf_recordset_ key in Array
 */ 
/**
 * No RecordSet
 */
define("AMFR_NONE",0); 
/**
 * Make an Array
 */
define("AMFR_ARRAY",1); 
/**
 * Make an ArrayCollection
 */
define("AMFR_ARRAY_COLLECTION",1); 
/**#@-*/

/**#@+
 * Types of data returned by the amf_decode_callback defined by the user
 */ 
/**
 * Maps a classname to an object or array. $arg is the classname. Returns a new object or array
 */
define("AMFE_MAP",1);
/**
 * Invoked after the decoding of any object. $arg is the object. Returns the new value.
 * Invoked only if AMF_POST_DECODE flag has been passed
 */
define("AMFE_POST_OBJECT",2);
/**
 * Invoked after the decoding of a XML string. Returns the resulting value
 */
define("AMFE_POST_XML",3);
/**
 * Maps a classname of an externalizable class. $arg  is the classname. Returns a new object or array
 */
define("AMFE_MAP_EXTERNALIZABLE",4);

/**
 * Triggered when a ByteArray is decoded in AMF3 decoding. The ByteArray is decoded as string and passed to the callback
 */
define("AMFE_POST_BYTEARRAY",5);

/**
 * Translate a string
 */
define("AMFE_TRANSLATE_CHARSET",6);

/**#@-*/

/**
 *  decodes an AMF message into a PHP value
 *  @param $value mixed  is the value that is necessary to be encoded 
 *  @param $flags integer modify the encoder behavior. It accepts AMF_AMF3 and AMF_BIG_ENDIAN
 *  @param $callback mixed specifies a callback function that is invoked when an object is encountered. The callback can be a function specified by its name or an object method pair specified by array(object, methodname)
 *  @return string containing the AMF encoding
 *
 *  @see amf_decode_callback
 */
function amf_decode($message, &$flags = 0, &$offset, $callback = NULL) {}
 
/**
 *  encodes a value into AMF format
 *  @param $value mixed is the value that is necessary to be encoded 
 *  @param $flags integer modify the encoder behavior. It accepts AMF_AMF3 and AMF_BIG_ENDIAN
 *  @param $callback mixed specifies a callback function that is invoked when an object is encountered. The callback can be a function specified by its name or an object method pair specified by array(object, methodname)
 *  @param $output_sb resource. When specified is the StringBuilder to use when writing the output
 *  @return string containing the AMF encoding
 *
 *  @see amf_encode_callback
 */
function amf_encode($value, $flags = 0, $callback = "", $output_sb = NULL) {}

/**
* This is the description of the callback invoked by the encoder
 * @param $event object is the event: AMFE_MAP or AMFE_TRANSLATE_CHARSET
 * @param $value is the object that needs to be encoded for AMFE_MAP, or the string to be translated for AMFE_TRANSLATE_CHARSET
 * @return mixed specifies how the object should be interpreted for AMFE_MAP or the translated string for  AMFE_TRANSLATE_CHARSET
 *
 * AMFE_MAP event
 * The encode callback receives a value to be encoded. It can be an object or a resource. For objects the classname is the name of the object class. This callback can return a single value
 * that is treated as a new TYPEDOBJECT or, alternatively it should return an array with three values (value, type, classname). The type is one of the AMFC_XXXX types that specifies
 * how to consider the value result. Finally in the case of AMFC_TYPEDOBJECT the classname value specifies the classname passed to the encoder.
 *
 * AMFE_TRANSLATE_CHARSET event (only if AMF_TRANSLATE_CHARSET flag was set)
 * The argument is a string that should be encoded into UTF8. It is not invoked for byte arrays or XML
 *
 * Check the special case for AMF_TRANSLATE_CHARSET_NOASCII
 */
function amf_encode_callback(&$value,$event) {}

/**
* This is the description of the callback invoked by the decoder
 * @param $event integer one of the possible event types AMFE_POST_DECODE or AMFE_MAP
 * @param $arg mixed depends on the event. See later
 * @return mixed the object that is generated by the processing. See later
 *
 * The behaviour of the callback depends on the $event argument:
 *
 * AMFE_MAP event: invoked when an object is going to be decoded. $arg is the classname. If the callback returns NULL the decoder creates a new object of the specified class
 * or an array if AMF_ASSOCIATIVE_DECODE flag is set. In the case of an array the _explicityType key is set to the classname. The callback can return an array or object.
 * 
 * AMFE_MAP_EXTERNALIZABLE event: invoked when an object is going to be decoded and its class is externalizable. $arg is the classname. If the callback returns NULL the
 * decoder reads another mixed variable otherwise it uses the return type as value.
 *
 * AMFE_POST_DECODE event: invoked AFTER every object is decoded but only if the AMF_POST_DECODE flag has been passed to amf_decode
 *
 * AMFE_POST_XML event: invoked when XML data has been encountered. It allows the invoker to transform the XML data into an object
 *
 * AMFE_TRANSLATE_CHARSET event: invoked for decoding a string from UTF8 into the PHP encoding. Check AMF_TRANSLATE_CHARSET_NOASCII
 * for the special case. 
 */
function amf_decode_callback($event, $arg) {}

/**
 * Joins multiple strings using the internal buffer of this extension
 * It accepts a lot of parameters and if a parameter is an array it traverses it
 *
 * Defined internally for testing
 */
function amf_join_test($v1, $v2, ...) {}

/**
 * Creates a new String Builder Resource
 * @param $sb resource
 */
function amf_sb_new() {}

/**
 * Appends the argument to the String Builder. The arguments can be strings,arrays or other StringBuilders
 * @param $sb resource is the String Buildr
 * @param $v1 the arguments
 */
function amf_sb_append($sb,$v1,$v2,...) {}

/**
 * Returns the length of the String Builder
 * @param $sb the resource
 * @return the length
 */
function amf_sb_length($sb) {}

/**
 * Returns the string representation of the String Builder
 * @param $sb the resource
 * @return the string representation
 */
function amf_sb_flat($sb) {}

/**
 * Returns the string representation of the String Builder
 * @param $sb the resource
 * @return the string representation
 */
function amf_sb_as_string($sb) {}

/**
 * Writes the String Builder into a stream/file
 *
 * @param $sb resource The String Builder
 * @param $stream resource The stream into write. If not specified writes to STDOUT as echo
 */
function amf_sb_write($sb, $stream = NULL) {}
?>