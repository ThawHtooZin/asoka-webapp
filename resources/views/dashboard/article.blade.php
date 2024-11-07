@extends('adminlte::page')

@section('content_header')
@endsection

@section('content')
    <div class="px-10 pt-5">
        <button class="btn btn-primary mb-3" onclick="openAddModal()">Add Article</button>

        <table id="articletable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ Str::limit($article->description, 100, '...') }}</td>
                        <td>{{ optional($article->user)->name ?? 'No User' }}</td>
                        <td>{{ optional($article->category)->name ?? 'No Category' }}</td>
                        <td>{{ date('d-m-Y', strtotime($article->created_at)) }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button onclick="openEditModal({{ $article->id }})" class="btn btn-info">Edit</button>

                            <!-- Delete Button -->
                            <button onclick="deleteArticle({{ $article->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $article->id }}" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Article</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editArticleForm" method="POST" action="/dashboard/articles/{{ $article->id }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" id="editArticleId">
                                        <div class="form-group">
                                            <label for="editArticleTitle">Article Title</label>
                                            <input type="text" class="form-control" id="editArticleTitle" name="title"
                                                required value="{{ $article->title }}">

                                            <label for="editArticleDescription">Article Description</label>
                                            <textarea class="form-control" id="editArticleDescription" name="description" required cols="30" rows="7">{{ $article->description }}</textarea>

                                            <label for="AuthorCategory">Article Category</label>
                                            <select class="form-control" name="category_id" id="AuthorCategory" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($category->id == $article->article_category_id) : {{ 'selected' }} @endif>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Create a New Article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addArticleForm" method="POST" action="/dashboard/articles/">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ArticleTitle">Article Title</label>
                                <input type="text" class="form-control" id="ArticleTitle" name="title" required>

                                <label for="ArticleDescription">Article Description</label>
                                <textarea class="form-control" id="ArticleDescription" name="description" required cols="30" rows="4"></textarea>

                                <label for="AuthorCategory">Article Category</label>
                                <select class="form-control" name="category_id" id="AuthorCategory" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Article</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#articletable').DataTable({
                    pageLength: 4
                });
            });


            // Function to open Add Modal
            function openAddModal() {
                $('#addModal').modal('show');
            }

            function openEditModal(id) {
                var modalid = '#editModal' + id;
                console.log(modalid);
                $(modalid).modal('show');
            }

            // Function to handle delete request
            function deleteArticle(id) {
                if (confirm("Are you sure you want to delete this article?")) {
                    // Create a temporary form to send the DELETE request
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/articles/${id}`;

                    // Add CSRF token
                    let csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    // Add hidden DELETE method input
                    let methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    // Append to the body and submit the form
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        </script>
    </div>
@endsection
