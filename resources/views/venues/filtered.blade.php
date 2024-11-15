@extends('dashboard.master')

@section('title', 'Filter Venues')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Venues</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Venues</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <!-- Filter Form -->
            <form action="{{ route('venues.filter.page') }}" method="GET">
                <button type="submit" class="btn btn-primary">Reset Filters</button>

                <div class="form-group">
                    <label for="categoryDropdown">Select Category:</label>
                    <select id="categoryDropdown" name="category" class="form-control">
                        <option value="">-- Select Category --</option>
                        @if(isset($categories) && $categories->count() > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category['name'] }}">{{ $category['title'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="categoryIdDropdown">Select Category ID:</label>
                    <select id="categoryIdDropdown" name="categoryId" class="form-control">
                        <option value="">-- Select Category ID --</option>
                        <!-- Options will be populated dynamically based on selected category -->
                    </select>
                </div>

            </form>

            <!-- Venues List -->
            <div id="venuesList">
                @if(isset($venues) && $venues->count() > 0)
                    <div class="mt-4">
                        <h2>Filtered Venues List</h2>
                        <ul class="list-group">
                            @foreach($venues as $venue)
                                <li class="list-group-item">{{ $venue->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif(isset($venues))
                    <div class="mt-4">
                        <p>No venues found for the selected filters.</p>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@section('ajax')
    <script>
        const baseUrl = "{{ url('/') }}"; // Laravel base URL

        document.addEventListener("DOMContentLoaded", function () {
            const categoryDropdown = document.getElementById('categoryDropdown');
            const categoryIdDropdown = document.getElementById('categoryIdDropdown');

            if (categoryDropdown) {
                categoryDropdown.addEventListener('change', function () {
                    console.log("Category changed!"); // Debug message

                    const selectedCategory = categoryDropdown.value;
                    console.log("Selected category:", selectedCategory);

                    fetch(`${baseUrl}/api/${selectedCategory}/ids`) // Full URL with base
                        .then(response => response.json())
                        .then(data => {
                            console.log("Data fetched:", data); // Debug message
                            categoryIdDropdown.innerHTML = ''; // Clear previous options
                            const option = document.createElement('option');
                            option.value = "";
                            option.textContent = "";
                            categoryIdDropdown.appendChild(option);
                            data.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.id;
                                option.textContent = item.name;
                                categoryIdDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching category IDs:', error));
                });
                categoryIdDropdown.addEventListener('change', function () {
                    console.log("CategoryId changed!"); // Debug message

                    const selectedCategory = categoryDropdown.value;
                    const selectedCategoryId = categoryIdDropdown.value;
                    console.log("Selected category:", selectedCategory);

                    $.ajax({
                        url: "{{ route('filter-venues') }}",
                        method: 'GET',
                        data: {
                            category: selectedCategory,
                            categoryId: selectedCategoryId
                        },
                        success: function (response) {
                            // نمایش فیلترها و نتایج
                            $('#venuesList').html(response.venues);
                        }
                    });
                });
            } else {
                console.error("categoryDropdown element not found");
            }
        });
    </script>

@endsection
