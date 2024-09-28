<?php

return [

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

    'accepted' => ':attribute måste accepteras.',
    'active_url' => ':attribute är inte en giltig URL.',
    'after' => ':attribute måste vara ett datum efter :date.',
    'after_or_equal' => ':attribute måste vara ett datum efter eller lika med :date.',
    'alpha' => ':attribute får endast innehålla bokstäver.',
    'alpha_dash' => ':attribute får endast innehålla bokstäver, siffror, streck och understreck.',
    'alpha_num' => ':attribute får endast innehålla bokstäver och siffror.',
    'array' => ':attribute måste vara en array.',
    'before' => ':attribute måste vara ett datum före :date.',
    'before_or_equal' => ':attribute måste vara ett datum före eller lika med :date.',
    'between' => [
        'numeric' => ':attribute måste vara mellan :min och :max.',
        'file' => ':attribute måste vara mellan :min och :max kilobyte.',
        'string' => ':attribute måste vara mellan :min och :max tecken.',
        'array' => ':attribute måste ha mellan :min och :max objekt.',
    ],
    'boolean' => ':attribute måste vara sant eller falskt.',
    'confirmed' => ':attribute bekräftelsen matchar inte.',
    'date' => ':attribute är inte ett giltigt datum.',
    'date_equals' => ':attribute måste vara ett datum lika med :date.',
    'date_format' => ':attribute matchar inte formatet :format.',
    'different' => ':attribute och :other måste vara olika.',
    'digits' => ':attribute måste vara :digits siffror.',
    'digits_between' => ':attribute måste vara mellan :min och :max siffror.',
    'dimensions' => ':attribute har ogiltiga bildmått.',
    'distinct' => ':attribute-fältet har en duplicerad värde.',
    'email' => ':attribute måste vara en giltig e-postadress.',
    'ends_with' => ':attribute måste sluta med en av följande: :values',
    'exists' => 'Det valda :attribute är ogiltigt.',
    'file' => ':attribute måste vara en fil.',
    'filled' => ':attribute-fältet måste ha ett värde.',
    'gt' => [
        'numeric' => ':attribute måste vara större än :value.',
        'file' => ':attribute måste vara större än :value kilobyte.',
        'string' => ':attribute måste vara längre än :value tecken.',
        'array' => ':attribute måste innehålla mer än :value objekt.',
    ],
    'gte' => [
        'numeric' => ':attribute måste vara större än eller lika med :value.',
        'file' => ':attribute måste vara större än eller lika med :value kilobyte.',
        'string' => ':attribute måste vara längre än eller lika med :value tecken.',
        'array' => ':attribute måste innehålla :value objekt eller mer.',
    ],
    'image' => ':attribute måste vara en bild.',
    'in' => 'Det valda :attribute är ogiltigt.',
    'in_array' => ':attribute-fältet finns inte i :other.',
    'integer' => ':attribute måste vara ett heltal.',
    'ip' => ':attribute måste vara en giltig IP-adress.',
    'ipv4' => ':attribute måste vara en giltig IPv4-adress.',
    'ipv6' => ':attribute måste vara en giltig IPv6-adress.',
    'json' => ':attribute måste vara en giltig JSON-sträng.',
    'lt' => [
        'numeric' => ':attribute måste vara mindre än :value.',
        'file' => ':attribute måste vara mindre än :value kilobyte.',
        'string' => ':attribute måste vara kortare än :value tecken.',
        'array' => ':attribute måste innehålla färre än :value objekt.',
    ],
    'lte' => [
        'numeric' => ':attribute måste vara mindre än eller lika med :value.',
        'file' => ':attribute måste vara mindre än eller lika med :value kilobyte.',
        'string' => ':attribute måste vara kortare än eller lika med :value tecken.',
        'array' => ':attribute får inte innehålla fler än :value objekt.',
    ],
    'max' => [
        'numeric' => ':attribute får inte vara större än :max.',
        'file' => ':attribute får inte vara större än :max kilobyte.',
        'string' => ':attribute får inte vara längre än :max tecken.',
        'array' => ':attribute får inte innehålla fler än :max objekt.',
    ],
    'mimes' => ':attribute måste vara en fil av typen: :values.',
    'mimetypes' => ':attribute måste vara en fil av typen: :values.',
    'min' => [
        'numeric' => ':attribute måste vara minst :min.',
        'file' => ':attribute måste vara minst :min kilobyte.',
        'string' => ':attribute måste vara minst :min tecken.',
        'array' => ':attribute måste innehålla minst :min objekt.',
    ],
    'not_in' => 'Det valda :attribute är ogiltigt.',
    'not_regex' => ':attribute-formatet är ogiltigt.',
    'numeric' => ':attribute måste vara ett nummer.',
    'present' => ':attribute-fältet måste vara närvarande.',
    'regex' => ':attribute-formatet är ogiltigt.',
    'required' => ':attribute-fältet är obligatoriskt.',
    'required_if' => ':attribute-fältet är obligatoriskt när :other är :value.',
    'required_unless' => ':attribute-fältet är obligatoriskt om inte :other finns i :values.',
    'required_with' => ':attribute-fältet är obligatoriskt när :values är närvarande.',
    'required_with_all' => ':attribute-fältet är obligatoriskt när :values är närvarande.',
    'required_without' => ':attribute-fältet är obligatoriskt när :values inte är närvarande.',
    'required_without_all' => ':attribute-fältet är obligatoriskt när ingen av :values är närvarande.',
    'same' => ':attribute och :other måste matcha.',
    'size' => [
        'numeric' => ':attribute måste vara :size.',
        'file' => ':attribute måste vara :size kilobyte.',
        'string' => ':attribute måste vara :size tecken.',
        'array' => ':attribute måste innehålla :size objekt.',
    ],
    'starts_with' => ':attribute måste börja med en av följande: :values',
    'string' => ':attribute måste vara en sträng.',
    'timezone' => ':attribute måste vara en giltig tidszon.',
    'unique' => ':attribute har redan tagits.',
    'uploaded' => ':attribute misslyckades att ladda upp.',
    'url' => ':attribute-formatet är ogiltigt.',
    'uuid' => ':attribute måste vara en giltig UUID.',

    /*
        |--------------------------------------------------------------------------
        | Anpassade valideringsmeddelanden
        |--------------------------------------------------------------------------
        |
        | Här kan du ange anpassade valideringsmeddelanden för attribut genom att
        | använda konventionen "attribute.rule" för att namnge raderna. Detta gör det snabbt att
        | ange ett specifikt anpassat språkmeddelande för en given attributregel.
        |
        */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'anpassat-meddelande',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        "email" => "E-Photo",
        "name" => "Namn",
        "address" => "Adress",
        "phone" => "Telefon",
        "organization_name" => "Organisationsnamn",
        "org_registration_number" => "Organisationsregistreringsnummer",
        "country" => "Land",
        "category_id" => "Kategorians-ID",
        "linkedin" => "Linkedin",
        "website_url" => "Webbplatsadress",
        "available_start_date" => "Tillgängligt startdatum",
        "cover_letter" => "Följebrev",
        "resume" => "CV",
        "message" => "Meddelande",
    ],


];