@extends("html-generators::layouts.docs")

@section('content')

    <h1>Forms</h1>
    <hr/>

    {{
        Panel::make('default')
            ->addTitle('FormField')
            ->addBody(
                FormField::username() .
                FormField::password() .
                FormField::myCustomTextarea(['type' => 'textarea', 'label' => 'Custom Label', 'rows' => 4]) .
                "<pre>\nFormField::username();\nFormField::password();\nFormField::myCustomTextarea(['type' => 'textarea', 'label' => 'Custom Label', 'rows' => 4]);</pre>"
            )
    }}

<?php
    use Mosaicpro\HtmlGenerators\Form\FormBuilder;
    $formbuilder = new FormBuilder;
    ?>

    {{
        Panel::make('default')
            ->addTitle('Input')
            ->addBody(
                $formbuilder->get_input('input_name', 'Input Label', 'The value') .
                "<pre>FormBuilder::input('input_name', 'Input Label', 'The value');</pre>"
            )
    }}

    {{
        Panel::make('default')
            ->addTitle('Toggle Buttons')
            ->addBody(
                $formbuilder->get_radio_buttons('name', 'Radio Buttons', 'on', ['on' => 'On', 'off' => 'Off']) . "<br/><br/>" .
                "<pre>FormBuilder::radio_buttons('name', 'Radio Buttons', 'on', ['on' => 'On', 'off' => 'Off']);</pre><hr/>" .
                $formbuilder->get_checkbox_buttons('name[]', 'Checkbox Buttons', ['optionA', 'optionB'], ['optionA' => 'Option A', 'optionB' => 'Option B', 'optionC' => 'Option C']) . "<br/><br/>" .
                "<pre>FormBuilder::checkbox_buttons('name[]', 'Checkbox Buttons', ['optionA', 'optionB'], ['optionA' => 'Option A', 'optionB' => 'Option B', 'optionC' => 'Option C']);</pre>"
            )
    }}

    {{
        Panel::make('default')
            ->addTitle('Select')
            ->addBody(
                $formbuilder->get_select('select_name', 'Select Label', 'value2', ['value1' => 'value1 label', 'value2' => 'value2 label', 'value3' => 'value3 label', 'value4' => 'value4 label', 'value5' => 'value5 label']) .
                "<pre>FormBuilder::select('select_name', 'Select Label', 'value2', ['value1' => 'value1 label', 'value2' => 'value2 label', 'value3' => 'value3 label', 'value4' => 'value4 label', 'value5' => 'value5 label']);</pre><hr/>" .
                $formbuilder->get_select_multiple('select_name[]', 'Select Label', ['value2', 'value3'], ['value1' => 'value1 label', 'value2' => 'value2 label', 'value3' => 'value3 label', 'value4' => 'value4 label', 'value5' => 'value5 label']) .
                "<pre>FormBuilder::select_multiple('select_name[]', 'Select Label', ['value2', 'value3'], ['value1' => 'value1 label', 'value2' => 'value2 label', 'value3' => 'value3 label', 'value4' => 'value4 label', 'value5' => 'value5 label']);</pre><hr/>" .
                $formbuilder->get_select_hhmmss('name', 'Select Time (hh:mm:ss)', ['hh' => '01', 'mm' => '30', 'ss' => '25']) .
                "<pre>FormBuilder::select_hhmmss('name', 'Select Time (hh:mm:ss)', ['hh' => '01', 'mm' => '30', 'ss' => '25']);</pre><hr/>"
            )
    }}


@stop