'use strict';
//full_editor_1 ==> full_editor_1_value
if (document.getElementById("full_editor_1_en")) {
    let quill_1 = new Quill('#full_editor_1_en', {
        bounds: '#full_editor_1_en',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });
    quill_1.on('text-change', function () {
        $("#full_editor_1_value_en").val($("#full_editor_1_en .ql-editor").html())
    });
}
if (document.getElementById("full_editor_1_ar")) {
    let quill_2 = new Quill('#full_editor_1_ar', {
        bounds: '#full_editor_1_ar',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });
    quill_2.on('text-change', function () {
        $("#full_editor_1_value_ar").val($("#full_editor_1_ar .ql-editor").html())
    });
}

if (document.getElementById("full_editor_1_sv")) {
    let quill_3 = new Quill('#full_editor_1_sv', {
        bounds: '#full_editor_1_sv',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });
    quill_3.on('text-change', function () {
        $("#full_editor_1_value_sv").val($("#full_editor_1_sv .ql-editor").html())
    });
}
//full_editor_1 ==> full_editor_1_value

//full_editor_2 ==> full_editor_2_value

if (document.getElementById("full_editor_2_en")) {

    let quill_4 = new Quill('#full_editor_2_en', {
        bounds: '#full_editor_2_en',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_4.on('text-change', function () {
        $("#full_editor_2_value_en").val($("#full_editor_2_en .ql-editor").html())

    });
}
if (document.getElementById("full_editor_2_ar")) {
    let quill_5 = new Quill('#full_editor_2_ar', {
        bounds: '#full_editor_2_ar',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_5.on('text-change', function () {
        $("#full_editor_2_value_ar").val($("#full_editor_2_ar .ql-editor").html())

    });
}

if (document.getElementById("full_editor_2_sv")) {
    let quill_6 = new Quill('#full_editor_2_sv', {
        bounds: '#full_editor_2_sv',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],

                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_6.on('text-change', function () {
        $("#full_editor_2_value_sv").val($("#full_editor_2_sv .ql-editor").html())

    });
}

//full_editor_2 ==> full_editor_2_value


//full_editor_3 ==> full_editor_3_value
if (document.getElementById("full_editor_3_en")) {
    let quill_7 = new Quill('#full_editor_3_en', {
        bounds: '#full_editor_3_en',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_7.on('text-change', function () {
        $("#full_editor_3_value_en").val($("#full_editor_3_en .ql-editor").html())

    });
}
if (document.getElementById("full_editor_3_ar")) {
    let quill_8 = new Quill('#full_editor_3_ar', {
        bounds: '#full-editor3_ar',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_8.on('text-change', function (delta, oldDelta, source) {
        $("#full_editor_3_value_ar").val($("#full_editor_3_ar .ql-editor").html())
    });
}

if (document.getElementById("full_editor_3_sv")) {
    let quill_9 = new Quill('#full_editor_3_sv', {
        bounds: '#full_editor_3_sv',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_9.on('text-change', function () {
        $("#full_editor_3_value_sv").val($("#full_editor_3_sv .ql-editor").html())
    });
}

//full_editor_3 ==> full_editor_3_value

//full_editor_4 ==> full_editor_4_value
if (document.getElementById("full_editor_4_en")) {

    let quill_10 = new Quill('#full_editor_4_en', {
        bounds: '#full_editor_4_en',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_10.on('text-change', function (delta, oldDelta, source) {
        $("#full_editor_4_value_en").val($("#full_editor_4_en .ql-editor").html())

    });
}
if (document.getElementById("full_editor_4_ar")) {
    let quill_11 = new Quill('#full_editor_4_ar', {
        bounds: '#full-editor4_ar',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_11.on('text-change', function () {
        $("#full_editor_4_value_ar").val($("#full_editor_4_ar .ql-editor").html())

    });
}

if (document.getElementById("full_editor_4_sv")) {
    let quill_12 = new Quill('#full_editor_4_sv', {
        bounds: '#full_editor_4_sv',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });
    quill_12.on('text-change', function () {
        $("#full_editor_4_value_sv").val($("#full_editor_4_sv .ql-editor").html())
    });
}
//full_editor_4 ==> full_editor_4_value



//full_editor_5 ==> full_editor_5_value
if (document.getElementById("full_editor_5_en")) {

    let quill_13 = new Quill('#full_editor_5_en', {
        bounds: '#full_editor_5_en',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_13.on('text-change', function () {
        $("#full_editor_5_value_en").val($("#full_editor_5_en .ql-editor").html())

    });
}
if (document.getElementById("full_editor_5_ar")) {
    let quill_14 = new Quill('#full_editor_5_ar', {
        bounds: '#full-editor5_ar',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_14.on('text-change', function () {
        $("#full_editor_5_value_ar").val($("#full_editor_5_ar .ql-editor").html())

    });
}

if (document.getElementById("full_editor_5_sv")) {
    let quill_15 = new Quill('#full_editor_5_sv', {
        bounds: '#full_editor_5_sv',
        placeholder: 'Write Here...',
        modules: {
            formula: !0,
            toolbar: [
                [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                ['link'],
                [{ align: 'justify' }, { align: 'right' }, { align: 'center' }], , ['clean']
            ]
        },
        theme: 'snow'
    });

    quill_15.on('text-change', function () {
        $("#full_editor_5_value_sv").val($("#full_editor_5_sv .ql-editor").html())

    });
}
//full_editor_5 ==> full_editor_5_value

