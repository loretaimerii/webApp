<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Cascadia+Mono:ital,wght@0,200..700;1,200..700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <title>Web App</title>
    </head>
    <body class="bg-gray-950 font-['Cascadia_Mono']">
        <nav class="bg-gray-950 p-5 text-white text-lg flex justify-between items-center border-b-2 border-gray-700">
            <a class="font-bold text-2xl flex justify-start">Blog Writer</a>
            <div class="flex justify-end">
                <a href="{{ route('home') }}" class="mr-3 hover:underline hover:underline-offset-8 hover:decoration-white">Home</a>
            
                @auth
                    <a href="{{ route('myPosts') }}" class="mr-3 hover:underline hover:underline-offset-8 hover:decoration-white">My Posts</a>
                    <a href="{{ route('profile.edit', auth()->user()->id) }}" class="mr-3 hover:underline hover:underline-offset-8 hover:decoration-white">Profile</a>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="ml-20 hover:underline hover:underline-offset-8 hover:decoration-white rounded-2xl">Log out</button>
                    </form>              
                @else
                    <a href="{{ route('login') }}" class="mr-3 hover:underline hover:underline-offset-8 hover:decoration-white">Login</a>
                    <a href="{{ route('signup') }}" class="hover:underline hover:underline-offset-8 hover:decoration-white">Signup</a>
                @endauth
            </div>
        </nav>
        
        {{-- display posts of the logged in user --}}
        <div class="flex items-center justify-center my-20 mx-10">
            <div class="border-t-2 border-gray-700 flex-grow"></div>
            <h1 class="mx-4 text-3xl font-bold text-white whitespace-nowrap">My Posts</h1>
            <div class="border-t-2 border-gray-700 flex-grow"></div>
        </div>
        
        <div class="grid grid-cols-3">
            {{-- create a new post --}}
            <div class="mx-6 mb-10 bg-[#232120] p-3 rounded-xl h-[500px] overflow-auto">
                <h1 class="text-center font-bold text-2xl my-4 text-[#29dae4]">Create a new post</h1>
                <form action="/create-post" method="POST" class="mx-10">
                    @csrf
                    <input type="text" name="title" id="title" placeholder="Post Title" class="bg-purple-50 rounded-xl p-2 mt-4 mb-5 w-80">
                    <textarea name="body" id="body" placeholder="Post content" class="bg-purple-50 rounded-2xl p-2 w-80 h-50 mb-5"></textarea>
                    <button type="submit" class="p-3 text-xl mt-10 font-bold text-[#29dae4] hover:underline hover:underline-offset-8 hover:decoration-[#29dae4]">Create</button>
                </form>
            </div>
            {{-- displays posts --}}
            @foreach($posts as $post)
                <div class="mx-6 mb-10 bg-[#232120] p-3 rounded-xl h-[500px] overflow-auto flex flex-col justify-between">
                    <div>
                        <h3 class="text-center font-bold text-2xl my-4 text-[#29dae4]">{{$post['title']}}</h3>
                        <p class="text-white p-3">{{$post['body']}}</p>
                    </div>
                    <div class="mt-3">
                        <div class="flex justify-between items-center">
                            <p><a href="/edit-post/{{$post->id}}" class="hover:font-bold text-[#767678] flex justify-start">Edit</a></p>
                            <p class="flex justify-end font-bold text-[#767678]">Created at: {{$post['created_at']}}</p>
                        </div>

                        <div class="flex justify-between items-center">
                            <form action="/delete-post/{{$post->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="hover:font-bold text-[#767678] flex justify-start">Delete</button>
                            </form>
                            <p class="flex justify-end font-bold text-[#767678]">Updated at: {{$post['updated_at']}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </body>
</html>