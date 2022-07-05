<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/index.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Exo+2:wght@200&display=swap');
    </style>
</head>

<body>
    <section class="nav">
        <div class="header">
            <div class="header-item">
                <div class="logo">
                    <a href="/" class="heart">
                        Mr.Hunger
                    </a>
                </div>
                <div class="item-des">
                    <div class="dropdown">
                        <button class="drop">
                            <img width="20px" src="/images/square.png" alt="">
                        </button>
                        <div class="dropdown-content">
                            @foreach($categories as $category)
                            <a value="{{ request('category') }}"
                                href="/category/{{ $category->category_name }}">{{ $category->category_name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <button class="search-button">
                        <img src="/images/magnifying-glass(1).png" alt="">
                    </button>
                    <form class="search-form" action="{{ url('/?search') }}" method="GET">
                        <button class="search-btn">
                            <img src="/images/search.svg" alt="">
                        </button>
                        <input type="text" name="search" class="search-box" placeholder="Search ..."
                            value="{{ request('search') }}">
                        <div class="search-cross">
                            <img src="/images/cross.png" alt="">
                        </div>
                    </form>
                </div>
                <div class="dark-light">
                    @auth
                    <button class="add-cat">
                        <img src="/images/plusone.png" alt="">
                    </button>
                    @endauth
                    <div class="edit">
                        <div class="edit-form contact-form">
                            <img class="edit-close" src="/images/cross.svg" alt="">
                            <form class="create-edit" action="/create" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="grid">
                                    <div class="grid-class">
                                        <div class="contact-content">
                                            <label for="" class="contact-label">Title</label>
                                            <input type="text" value="{{ old('title') }}" name="title"
                                                class="contact-input" required>
                                        </div>
                                        <div class="contact-inputs">
                                            <div class="contact-content">
                                                <label for="" class="contact-label">Category</label>
                                                <select name="category_name" class="contact-input">
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->category_name }}">
                                                        {{ $category->category_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contact-content right-grid">
                                        <label for="" class="contact-label">Description</label>
                                        <textarea contenteditable="true" name="description" id="editor"
                                            class="contact-input" name="description" required>
                                    </textarea>
                                    </div>
                                </div>
                                <input type="submit" value="Post" class="contact-button button"></input>
                            </form>
                        </div>
                    </div>
                    <div class="button-box">
                        <input name="check" type="checkbox" id="toggleTheme">
                        <label class="btn" for="toggleTheme"></label>
                        <button class="box-ind">
                            <img class="ind-img" src="/images/sun.png" alt="">
                        </button>
                        <button class="box-ind">
                            <img class="ind-img" src="/images/night-mode.png" alt="">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="top"></div>
    @yield('content')
    <div class="top"></div>
    @yield('detail')

    <section class="footer">
        <div class="container">
            <p class="container-p">
                &#169;
                <script>
                document.write(/\d{4}/.exec(Date())[0])
                </script>
                .
                All Rights Reserved
            </p>
            <div class="socials">
                <a href="https://www.facebook.com/mdysoftwareinstitute">
                    <img src="/images/facebook-one.png" alt="">
                </a>
                <a href="https://www.linkedin.com/in/nyi-nyi-aung-a77954130">
                    <img src="/images/linkedin-one.png" alt="">
                </a>
                <a href="https://github.com/nnatastysoft">
                    <img src="/images/github-one.png" alt="">
                </a>
            </div>
        </div>
    </section>

    <script src="/js/index.js"></script>
    <script>
    window.addEventListener('load', function() {
        document.querySelectorAll('oembed[url]').forEach(element => {
            // get just the code for this youtube video from the url
            let vCode = element.attributes.url.value.split('https://youtu.be/')[1];
            // paste some BS5 embed code in place of the Figure tag
            element.parentElement.outerHTML = `
    <div class="ratio ratio-16x9">
        <iframe src="https://www.youtube.com/embed/${vCode}"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>`;
        });
    })
    </script>
    @auth
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    const addBtn = document.querySelector('.add-cat');
    const Add = document.querySelector('.edit');
    const Edit = document.querySelector('.edit-close');

    addBtn.addEventListener('click', () => {
        Add.classList.add('show-add');
        Edit.classList.add('edit-crossShow');
    })
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>
    function DisallowNestingBlockQuotes(editor) {
        editor.model.schema.addChildCheck((context, childDefinition) => {
            if (context.endsWith('blockQuote') && childDefinition.name == 'blockQuote') {
                return false;
            }
        });
    }
    </script>
    <script>
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

    function SimpleUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }
    ClassicEditor
        .create(document.querySelector('#editor'), {
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

</body>

</html>