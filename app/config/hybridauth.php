<?php
return array(
	"base_url"   => url() . '/social/auth',
	"providers"  => array (

// Providers: Google - Facebook - Twitter - Yahoo - AOL - Windows Live - LinkedIn - FourSquare

// Main Providers (has button)

		"Google"     => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "922636421657-eud8ujgs41n72a1fafkoftlhn2tufc1r.apps.googleusercontent.com", "secret" => "ptFBStMqvLWLNv0G9ryWCa8S" ),
			"scope"      => "https://www.googleapis.com/auth/userinfo.profile ".
                            "https://www.googleapis.com/auth/userinfo.email"   ,
			),

		"Facebook"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "1414027872209217", "secret" => "3d0dd579d0f5a084cabb47490e76bc20" ),
			'scope'      =>  'email',
			),

		"Twitter"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "3aU1cITd18tb4Eeowu2KhfEYZ", "secret" => "oNk1OKqCeYbRPkpczkxmwIBHl43s8KbnKCA9pUP3fuKcGyq4WW" )
			)

/*		"LinkedIn" => array (
			"enabled" => true,
			"keys"    => array ( "key" => "", "secret" => "" )
			),
// Secondary Providers (text links)
		"Foursquare" => array (
			"enabled" => true,
			"keys"    => array ( "id" => "", "secret" => "" )
			),

		"Live" => array (
			"enabled" => true,
			"keys"    => array ( "id" => "", "secret" => "" )
			),

		"Yahoo" => array (
			"enabled" => true,
			"keys"    => array ( "id" => "", "secret" => "" ),
			),

		"AOL"  => array (
			"enabled" => true,
			)
*/
	),
);
