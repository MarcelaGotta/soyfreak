<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute debe de ser aceptado.",
	"active_url"           => "La :attribute no es un URL valido.",
	"after"                => "La :attribute debe de ser una fecha despues de :date.",
	"alpha"                => ":attribute solo puede contener letras.",
	"alpha_dash"           => ":attribute solo puede contener letras, numeros y guiones.",
	"alpha_num"            => ":attribute solo puede contener letras y numeros.",
	"array"                => ":attribute debe de ser un orden.",
	"before"               => "La :attribute debe de ser una fecha antes de :date.",
	"between"              => array(
		"numeric" => "El :attribute debe de ser entre :min y :max.",
		"file"    => "El :attribute debe de ser entre :min y :max kilobytes.",
		"string"  => "La :attribute debe de ser entre :min y :max caracteres.",
		"array"   => "El :attribute debe de ser entre :min y :max articulos.",
	),
	"confirmed"            => "La :attribute confirmacion no coincide.",
	"date"                 => "La :attribute no es una fecha valida.",
	"date_format"          => "El :attribute no coincide con el formato :format.",
	"different"            => ":attribute y :other deben de ser diferentes.",
	"digits"               => "Los :attribute deben de ser digitos :digits .",
	"digits_between"       => "Los :attribute deben de estar entre los digitos :min y :max .",
	"email"                => "El :attribute debe de ser una direccion de email valida.",
	"exists"               => "El :attribute seleccionado es invalido.",
	"image"                => "La :attribute debe de ser una imagen.",
	"in"                   => "El :attribute seleccionado es invalido.",
	"integer"              => "El :attribute debe de ser un entero.",
	"ip"                   => "La :attribute debe de ser una direccion de IP valida.",
	"max"                  => array(
		"numeric" => "El :attribute no puede ser mayor que :max.",
		"file"    => "El :attribute no debe de ser mayor que :max kilobytes.",
		"string"  => "La :attribute no debe de ser mayor que :max caracteres.",
		"array"   => "El :attribute no debe tener mas de :max articulos.",
	),
	"mimes"                => "El :attribute debe de ser un archivo del tipo: :values.",
	"min"                  => array(
		"numeric" => "El :attribute debe de ser al menos de :min.",
		"file"    => "El :attribute debe de ser al menos de :min kilobytes.",
		"string"  => "La :attribute debe de ser al menos de :min caracteres.",
		"array"   => "El :attribute debe de ser al menos de :min articulos.",
	),
	"not_in"               => "El :attribute seleccionado es invalido.",
	"numeric"              => "El :attribute debe de ser un numero.",
	"regex"                => "El formato :attribute es invalido.",
	"required"             => "El campo :attribute es requerido.",
	"required_if"          => "El campo :attribute es requerido cuando :other es :value.",
	"required_with"        => "El campo :attribute es requerido cuando :values esta presente.",
	"required_with_all"    => "El campo :attribute es requerido cuando :values estan presentes.",
	"required_without"     => "El campo :attribute es requerido cuando :values no estan presentes.",
	"required_without_all" => "El campo :attribute es requerido cuando ninguno de :values estan presentes.",
	"same"                 => ":attribute y :other deben coincidir.",
	"size"                 => array(
		"numeric" => "El :attribute debe de ser :size.",
		"file"    => "El :attribute debe de ser de :size kilobytes.",
		"string"  => "La :attribute debe de ser de :size caracteres.",
		"array"   => "La :attribute debe contener :size articulos.",
	),
	"unique"               => "El :attribute ya ha sido tomado.",
	"url"                  => "El formato :attribute es invalido.",
    "slug"                 => "El :attribute solo puede contener letras, numeros y guiones.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),


    /**
     * Version 2.1 additions
     */
    "predefined"           => "El valor dado no es aceptado por el campo :attribute ",
    "validalpha"           => "El campo :attribute no puede empezar con un numero"
);
