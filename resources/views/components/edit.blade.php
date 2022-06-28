@extends('components.layout')

@section('content')
@auth
<div class="edit-one">
    <form action="/editPost/{{ $post->id }}" enctype="multipart/form-data" method="POST"
        class="edit-form-one contact-form">
        @csrf
        @method('PATCH')
        <div class="grid">
            <div class="grid-class">
                <div class="contact-content">
                    <label for="" class="contact-label">Title</label>
                    <input type="text" value="{{ $post->title }}" name="title" class="contact-input" required>
                </div>
                <div class="contact-inputs">
                    <div class="contact-content">
                        <label for="" class="contact-label">Category</label>
                        <select name="category_name" class="contact-input">
                            @foreach($categories as $category)
                            <option value="{{ $category->category_name }}"
                                {{ $category->category_name == $post->category_name ? 'selected' : ''}}>
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="contact-content">
                <label for="" class="contact-label">Description</label>
                <textarea name="description" id="edit" class="contact-input" name="description" required>
                {!! $post->description !!}
            </textarea>
            </div>
        </div>
        <input type="submit" value="Post" class="contact-button button"></input>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
window.addEventListener('load', function() {
    document.querySelectorAll('oembed[url]').forEach(element => {
        // get just the code for this youtube video from the url
        let vCode = element.attributes.url.value.split('https://youtu.be/')[1];
        // paste some BS5 embed code in place of the Figure tag
        element.parentElement.outerHTML = `
    <div class="ratio ratio-16x9">
        <iframe src="https://www.youtube.com/embed/${vCode}"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>`;
    });
})

function DisallowNestingBlockQuotes(edit) {
    edit.model.schema.addChildCheck((context, childDefinition) => {
        if (context.endsWith('blockQuote') && childDefinition.name == 'blockQuote') {
            return false;
        }
    });
}

class MyUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }
    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                this._initRequest();
                this._initListeners(resolve, reject, file);
                this._sendRequest(file);
            }));
    }
    abort() {
        if (this.xhr) {
            this.xhr.abort();
        }
    }
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        xhr.open('POST', "{{ route('images.store') }}", true);;
        xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
        xhr.responseType = 'json';
    }

    _initListeners(resolve, reject, file) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;
        xhr.addEventListener('error', () => reject(genericErrorText));
        xhr.addEventListener('abort', () => reject());
        xhr.addEventListener('load', () => {
            const response = xhr.response;
            if (!response || response.error) {
                return reject(response && response.error ? response.error.message : genericErrorText);
            }
            resolve({
                default: response.url
            });
        });
        if (xhr.upload) {
            xhr.upload.addEventListener('progress', evt => {
                if (evt.lengthComputable) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            });
        }
    }

    _sendRequest(file) {
        const data = new FormData();

        data.append('upload', file);

        this.xhr.send(data);
    }
}

function SimpleUploadAdapterPlugin(edit) {
    edit.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        return new MyUploadAdapter(loader);
    };
}
ClassicEditor
    .create(document.querySelector('#edit'), {
        extraPlugins: [SimpleUploadAdapterPlugin, DisallowNestingBlockQuotes],
        link: {
            decorators: {
                openInNewTab: {
                    mode: 'manual',
                    label: 'Open in a new tab',
                    defaultValue: true,
                    attributes: {
                        target: '_blank',
                        rel: 'noopener noreferrer'
                    }
                }
            }
        },
        indentBlock: {
            offset: 1,
            unit: 'em'
        }
    })
    .catch(error => {
        console.error(error);
    })
</script>
@endauth
@endsection