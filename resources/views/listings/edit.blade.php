{{--{{dd($listing)}}--}}
<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-6">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Update a Gig
            </h2>
            <p class="mb-4">Post a gig to find a developer</p>
        </header>

        <form method="POST" action="/listings/{{$listing->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="company" class="inline-block text-lg mb-2">Company Name <span style="color: red">*</span></label>
                <input type="text"
                       class="border border-gray-200 rounded p-2 w-full"
                       name="company"
                       value="{{$listing->company}}"/>

                @error('company')
                <div class="text-red-500 text-xs mt-1">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Job Title <span style="color: red">*</span></label>
                <input type="text"
                       class="border border-gray-200 rounded p-2 w-full"
                       name="title"
                       placeholder="Example: Senior Laravel Developer"
                       value="{{$listing->title}}"/>

                @error('title')
                <div class="text-red-500 text-xs mt-1">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="location" class="inline-block text-lg mb-2">Job Location <span style="color: red">*</span></label>
                <input type="text"
                       class="border border-gray-200 rounded p-2 w-full"
                       name="location"
                       placeholder="Example: Remote, Boston MA, etc"
                       value="{{$listing->location}}"/>

                @error('location')
                <div class="text-red-500 text-xs mt-1">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Contact Email <span style="color: red">*</span></label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="email"
                    value="{{$listing->email}}"/>

                @error('email')
                <div class="text-red-500 text-xs mt-1">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="website" class="inline-block text-lg mb-2">
                    Website/Application URL <span style="color: red">*</span>
                </label>
                <input type="text"
                       class="border border-gray-200 rounded p-2 w-full"
                       name="website"
                       value="{{$listing->website}}"/>

                @error('website')
                <div class="text-red-500 text-xs mt-1">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tags (Comma Separated) <span style="color: red">*</span>
                </label>
                <input type="text"
                       class="border border-gray-200 rounded p-2 w-full"
                       name="tags"
                       placeholder="Example: Laravel, Backend, Postgres, etc"
                       value="{{$listing->tags}}"/>

                @error('tags')
                <div class="text-red-500 text-xs mt-1">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Company Logo
                </label>
                <input type="file"
                       class="border border-gray-200 rounded p-2 w-full"
                       name="logo"/>

                <img class="w-48 mr-6 mb-6" src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png')}}" alt=""/>

                @error('logo')
                <div class="text-red-500 text-xs mt-1">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Job Description <span style="color: red">*</span>
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full"
                          name="description"
                          rows="10"
                          placeholder="Include tasks, requirements, salary, etc"
                >{{$listing->description}}
                    </textarea>

                @error('description')
                <div class="text-red-500 text-xs mt-1">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Update Gig
                </button>
                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>
