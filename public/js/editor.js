    CKEDITOR.ClassicEditor.create(document.getElementById("konten_sk"), {
        toolbar: {
            items: [
                'ckbox', 'uploadImage', '|',
                'exportPDF', 'exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        htmlSupport: {
            allow: [
            {
                name: /^(div|section|article|varrs)$/
            },
            ]
        },
        htmlEmbed: {
            showPreviews: true
        },
        mention: {
            feeds: [
                {
                    marker: '#',
                    feed: getFeedItems,
                    minimumCharacters: 4,
                    itemRenderer: customItemRenderer
                }
            ]
        },
        removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType'
        ]
    }).then( editor => {

        window.editor = editor;
    } )
    .catch( err => {
        console.error( err );
    });

    function getFeedItems( queryText ) {
        return new Promise( resolve => {
            setTimeout( () => {
                const itemsToDisplay = items
                    .slice( 0, 10 );
                resolve( itemsToDisplay );
            }, 100 );
        } );
    }

    function customItemRenderer( item ) {
        const itemElement = document.createElement( 'span' );

        itemElement.classList.add( 'custom-item' );
        itemElement.id = `mention-list-item-id-${ item.userId }`;
        itemElement.textContent = `${ item.id } `;

        return itemElement;
    }
