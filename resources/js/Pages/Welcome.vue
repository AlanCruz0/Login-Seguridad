<script>
import { Head } from '@inertiajs/vue3';

export default {
    name: "WelcomePage",
    methods: {
        navigateToProducts() {
            window.location.href = "/products";
        },
        navigateToAbouts() {
            window.location.href = "/abouts";
        },
    },
};
</script>

<template>
        
    <div class="welcome-container flex flex-col min-h-screen">
        <header class="navbar w-full bg-gray-100 p-4">
            <nav class="flex justify-between items-center">
                <a href="/" class="flex items-center space-x-3">
                    <img
                        src="/images/Logo.webp"
                        alt="Coffee G Logo"
                        class="h-12 w-12 object-contain"
                    />
                    <span
                        class="text-2xl font-extrabold tracking-wide hover:text-gray-300"
                    >
                        Coffee G
                    </span>
                </a>
                <ul class="flex space-x-6">
                    <li>
                        <a
                            href="/login"
                            class="text-gray-700 hover:text-blue-600 underline"
                            >Iniciar sesion</a
                        >
                    </li>
                    <li>
                        <a
                            href="/register"
                            class="text-gray-700 hover:text-blue-600 underline"
                            >Registrar</a
                        >
                    </li>
                </ul>
            </nav>
        </header>

        <section
            class="hero bg-cover bg-center py-20"
            style="
                background-image: url('https://via.placeholder.com/1200x500');
            "
        >
            <div class="container mx-auto text-center text-brown-900">
                <h1 class="text-4xl md:text-6xl font-bold drop-shadow-md">
                    ¡Bienvenido al Coffee G!
                </h1>
                <p class="mt-4 text-lg md:text-xl drop-shadow-md">
                    Nos complace que nos visites. Descubre nuestros deliciosos
                    cafés y más.
                </p>
                <button disabled
                    class="mt-6 bg-blue-600 hover:bg-blue-700 text-white font-medium mx-2 py-3 px-6 rounded-lg shadow-lg transition"
                    @click="navigateToProducts"
                >
                    Productos
                </button>
                <button disabled
                    class="mt-6 bg-blue-600 hover:bg-blue-700 text-white font-medium mx-2 py-3 px-6 rounded-lg shadow-lg transition"
                    @click="navigateToAbouts"
                >
                    Nosotros
                </button>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-gray-400 py-6 mt-auto">
            <div class="container mx-auto text-center">
                <p>© 2025 Coffee G | Todos los derechos reservados</p>
                <div class="mt-4 flex justify-center space-x-4">
                    <a
                        href="https://facebook.com/cafebuen"
                        class="hover:text-blue-400 transition"
                    >
                        Facebook
                    </a>
                    <span>|</span>
                    <a
                        href="https://instagram.com/cafebuen"
                        class="hover:text-pink-400 transition"
                    >
                        Instagram
                    </a>
                    <span>|</span>
                    <a href="#" class="hover:text-pink-400 transition">
                        Contactanos
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
.hero {
    min-height: 60vh;
}
</style>
