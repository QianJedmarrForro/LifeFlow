<x-layout>
    <div class="flex items-center justify-center min-h-[70vh]">
        <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-md border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Login to LifeFlow</h2>
            
            <form action="/login" method="POST" class="space-y-4">
                @csrf
                <input type="email" placeholder="Email" class="w-full p-3 rounded border focus:ring-2 focus:ring-red-500 outline-none">
                <input type="password" placeholder="Password" class="w-full p-3 rounded border focus:ring-2 focus:ring-red-500 outline-none">
                
                <button type="submit" class="w-full bg-red-600 text-white py-3 rounded font-bold hover:bg-red-700 transition">
                    SIGN IN
                </button>
            </form>

            <p class="mt-6 text-center text-gray-600">
                Don't have an account? 
                <a href="/register" class="text-red-600 font-bold hover:underline">Sign Up</a>
            </p>
        </div>
    </div>
</x-layout>