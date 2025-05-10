<template>
  <div class="min-h-screen bg-gray-50">
    <nav class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <Link href="/" class="flex items-center">
              <span class="text-2xl font-bold text-blue-600">NinaCare</span>
            </Link>
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
              <Link
                href="/"
                class="inline-flex items-center px-1 pt-1 text-sm font-medium"
                :class="[$page.url === '/' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700']"
              >
                Home
              </Link>
              <Link
                href="/users"
                class="inline-flex items-center px-1 pt-1 text-sm font-medium"
                :class="[$page.url.startsWith('/users') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700']"
              >
                Users
              </Link>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <main class="py-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <slot />
      </div>
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
