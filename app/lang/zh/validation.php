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

	"accepted"             => "該 :attribute 必須接受.",
	"active_url"           => "該 :attribute 是不是有效的URL.",
	"after"                => "該 :attribute 必須經過日期 :date.",
	"alpha"                => "該 :attribute 可能只包含字母.",
	"alpha_dash"           => "該 :attribute 可能只包含字母，數字和破折號.",
	"alpha_num"            => "該 :attribute 只能包含字母和數字.",
	"array"                => "該 :attribute 必須是一個數組.",
	"before"               => "該 :attribute 必須是之前日期 :date.",
	"between"              => array(
		"numeric" => "該 :attribute 必須介於 :min 和 :max.",
		"file"    => "該 :attribute 必須介於 :min 和 :max 千字節.",
		"string"  => "該 :attribute 必須介於 :min 和 :max 字符.",
		"array"   => "該 :attribute 必須介於 :min 和 :max 項目.",
	),
	"confirmed"            => "該 :attribute 確認不匹配.",
	"date"                 => "該 :attribute 是不是有效的日期.",
	"date_format"          => "該 :attribute 不符合該格式 :format.",
	"different"            => "該 :attribute 和或必須不同.",
	"digits"               => "該 :attribute 必須是 :digits 數字.",
	"digits_between"       => "該 :attribute 必須是 :min 和 :max 數字.",
	"email"                => "該 :attribute 必須是 一個有效的電子郵件地址.",
	"exists"               => "該 選 :attribute 無效.",
	"image"                => "該 :attribute 必須是 圖像.",
	"in"                   => "該 選 :attribute 無效.",
	"integer"              => "該 :attribute 必須是 一個整數.",
	"ip"                   => "該 :attribute 必須是 一個有效的IP地址.",
	"max"                  => array(
		"numeric" => "該 :attribute 可能不大於 :max.",
		"file"    => "該 :attribute 可能不大於 :max 千字節.",
		"string"  => "該 :attribute 可能不大於 :max 字符.",
		"array"   => "該 :attribute 可能沒有超過 :max 項目.",
	),
	"mimes"                => "該 :attribute 必須是類型的文件: :values.",
	"min"                  => array(
		"numeric" => "該 :attribute 必須至少 :min.",
		"file"    => "該 :attribute 必須至少 :min 千字節.",
		"string"  => "該 :attribute 必須至少 :min 字符.",
		"array"   => "該 :attribute 必須至少 :min 項目.",
	),
	"not_in"               => "該 選 :attribute 無效.",
	"numeric"              => "該 :attribute 必須是一個數字.",
	"regex"                => "該 :attribute 格式無效.",
	"required"             => "該 :attribute 格式無效.",
	"required_if"          => "該 :attribute 場時，需要 存在 :value.",
	"required_with"        => "該 :attribute 場時，需要 :values 存在.",
	"required_with_all"    => "該 :attribute f場時，需要 :values 存在.",
	"required_without"     => "該 :attribute 場時，需要 :values 不存在.",
	"required_without_all" => "該 :attribute 場時，需要 沒有 :values 存在.",
	"same"                 => "該 :attribute 和 必須匹配.",
	"size"                 => array(
		"numeric" => "該 :attribute 必須是 :size.",
		"file"    => "該 :attribute 必須是 :size 千字節.",
		"string"  => "該 :attribute 必須是:size 字符.",
		"array"   => "該 :attribute 必須包含 :size 項目.",
	),
	"unique"               => "該 :attribute 已有人帶走了.",
	"url"                  => "該 :attribute 格式無效.",
    "slug"                 => "該 :attribute 可能只包含字母，數字和破折號.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using 該
	| convention "attribute.rule" to name 該 lines. This makes it quick to
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
	| 該 following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),


    /**
     * Version 2.1 additions
     */
    "predefined"           => "該 值給出不被接受的 :attribute 場",
    "validalpha"           => "該 :attribute 字段不能以數字開頭"
);
