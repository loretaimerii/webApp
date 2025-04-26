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
        
        {{-- edit profile --}}
        <div class="flex items-center justify-center my-20 mx-10">
            <div class="border-t-2 border-gray-700 flex-grow"></div>
            <h1 class="mx-4 text-3xl font-bold text-white whitespace-nowrap">Edit Profile</h1>
            <div class="border-t-2 border-gray-700 flex-grow"></div>
        </div>

        <div class="flex justify-center">
            <div class="bg-[#232120] p-6 m-6 mt-0 w-xl rounded-lg">
                @if(session('message'))
                <div class="text-[#29dae4] font-bold mb-6" id="fadeOut">
                    {{ session('message') }}
                </div>
                @endif
                <form action="/profile/{{$user->id}}" method="POST" class="">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center">
                        <input type="text" name="name" id="name" value="{{$user->name}}" class="bg-white rounded-xl p-2 mt-2 mb-5">
                        <input type="email" name="email" id="email" value="{{$user->email}}" class="bg-white rounded-xl p-2 mt-2 ml-6 mb-5">
                    </div>
                    <div class="flex items-center">
                        <input type="password" name="password" id="password" placeholder="Password" class="bg-white rounded-xl mt-2 p-2">
                    </div>
                    <div class="flex justify-end mt-3">
                        <button type="submit" id="submit" name="submit" class="p-3 text-xl font-bold text-[#29dae4] hover:underline hover:underline-offset-8 hover:decoration-[#29dae4]">Edit Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script>
        setTimeout(() => {
            document.getElementById('fadeOut').classList.add('opacity-0');
        }, 5000);  
    </script>
</html>