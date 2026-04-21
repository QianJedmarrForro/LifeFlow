<x-layout>
    <div class="flex items-center justify-center min-h-[70vh]">
        <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-md border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Create Account</h2>
            
            <form action="/register" method="POST" class="space-y-4">
                @csrf
                <input type="text" placeholder="Full Name" class="w-full p-3 rounded border">
                <input type="email" placeholder="Email" class="w-full p-3 rounded border">
                <input type="password" placeholder="Password" class="w-full p-3 rounded border">
                
                <button type="submit" class="w-full bg-red-600 text-white py-3 rounded font-bold hover:bg-red-700">
                    CREATE ACCOUNT
                </button>
            </form>

            <p class="mt-6 text-center text-gray-600">
                Already have an account? 
                <a href="/login" class="text-red-600 font-bold hover:underline">Login</a>
            </p>
        </div>
    </div>
</x-layout>