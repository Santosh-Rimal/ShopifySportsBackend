import './bootstrap';


                // CKEditor initialization function
                function initializeCkEditor(selector) {
                    document.querySelectorAll(selector).forEach(function(textarea) {
                        // Check if CKEditor is already applied to the element to avoid multiple instances
                        if (!textarea.classList.contains('ck-editor-applied')) {
                            CKEDITOR.ClassicEditor.create(textarea, {
                                toolbar: {
                                    items: [
                                        'heading', '|',
                                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                                        'superscript', 'removeFormat', '|',
                                        'bulletedList', 'numberedList', '|',
                                        'outdent', 'indent', '|',
                                        'undo', 'redo', '|',
                                        'fontSize', 'fontFamily', 'fontColor', '|',
                                        'alignment', '|',
                                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                                        'sourceEditing'
                                    ],
                                    shouldNotGroupWhenFull: true
                                },
                                list: {
                                    properties: {
                                        styles: true,
                                        startIndex: true,
                                        reversed: true
                                    }
                                },
                                heading: {
                                    options: [{
                                            model: 'paragraph',
                                            title: 'Paragraph',
                                            class: 'ck-heading_paragraph'
                                        },
                                        {
                                            model: 'heading1',
                                            view: 'h1',
                                            title: 'Heading 1',
                                            class: 'ck-heading_heading1'
                                        },
                                        {
                                            model: 'heading2',
                                            view: 'h2',
                                            title: 'Heading 2',
                                            class: 'ck-heading_heading2'
                                        },
                                        {
                                            model: 'heading3',
                                            view: 'h3',
                                            title: 'Heading 3',
                                            class: 'ck-heading_heading3'
                                        },
                                        {
                                            model: 'heading4',
                                            view: 'h4',
                                            title: 'Heading 4',
                                            class: 'ck-heading_heading4'
                                        },
                                        {
                                            model: 'heading5',
                                            view: 'h5',
                                            title: 'Heading 5',
                                            class: 'ck-heading_heading5'
                                        },
                                        {
                                            model: 'heading6',
                                            view: 'h6',
                                            title: 'Heading 6',
                                            class: 'ck-heading_heading6'
                                        }
                                    ]
                                },
                                placeholder: 'Enter text...',
                                fontFamily: {
                                    options: [
                                        'default',
                                        'Arial, Helvetica, sans-serif',
                                        'Courier New, Courier, monospace',
                                        'Georgia, serif',
                                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                                        'Tahoma, Geneva, sans-serif',
                                        'Times New Roman, Times, serif',
                                        'Trebuchet MS, Helvetica, sans-serif',
                                        'Verdana, Geneva, sans-serif'
                                    ],
                                    supportAllValues: true
                                },
                                fontSize: {
                                    options: [8, 10, 12, 14, 'default', 18, 20, 22, 24, 26, 28, 30, 32, 34, 36],
                                    supportAllValues: true
                                },
                                htmlSupport: {
                                    allow: [{
                                        name: /.*/,
                                        attributes: true,
                                        classes: true,
                                        styles: true
                                    }]
                                },
                                htmlEmbed: {
                                    showPreviews: true
                                },
                                link: {
                                    decorators: {
                                        addTargetToExternalLinks: true,
                                        defaultProtocol: 'https://',
                                        toggleDownloadable: {
                                            mode: 'manual',
                                            label: 'Downloadable',
                                            attributes: {
                                                download: 'file'
                                            }
                                        }
                                    }
                                },
                                mention: {
                                    feeds: [{
                                        marker: '@',
                                        feed: [
                                            '@apple', '@bears', '@brownie', '@cake', '@candy',
                                            '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                                            '@gingerbread', '@gummi', '@ice', '@jelly-o', '@liquorice',
                                            '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                                            '@pudding',
                                            '@sesame', '@snaps', '@soufflé', '@sugar', '@sweet',
                                            '@topping', '@wafer'
                                        ],
                                        minimumCharacters: 1
                                    }]
                                },
                                removePlugins: [
                                    'CKBox', 'CKFinder', 'EasyImage', 'RealTimeCollaborativeComments',
                                    'RealTimeCollaborativeTrackChanges', 'RealTimeCollaborativeRevisionHistory',
                                    'PresenceList', 'Comments', 'TrackChanges', 'TrackChangesData',
                                    'RevisionHistory', 'Pagination', 'WProofreader', 'MathType'
                                ]
                            }).then(editor => {
                                textarea.classList.add('ck-editor-applied'); // Mark as initialized
                            }).catch(error => {
                                console.error(error);
                            });
                        }
                    });
                }

                // Initialize CKEditor when the document is ready
                document.addEventListener("DOMContentLoaded", function() {
                    initializeCkEditor('.ckeditor'); // Initialize for all textareas with class 'ckeditor'
                });
