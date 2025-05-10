<template>
  <Layout>
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
      <div class="container mx-auto px-4 py-16">
        <!-- Hero Section -->
        <div class="text-center mb-16">
          <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
            User Management
          </h1>
          <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
            An application designed to handle 1 million user records
          </p>
          <Link
            href="/users"
            class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center gap-2"
          >
            <span>View Users</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </Link>
        </div>

        <!-- Features Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
          <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-blue-600 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Advanced Search</h3>
            <p class="text-gray-600">Search capabilities across all user records.</p>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-blue-600 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Large Dataset</h3>
            <p class="text-gray-600">Manages and displays 1 million user records.</p>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-blue-600 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Modern Stack</h3>
            <p class="text-gray-600">Built with Laravel, Inertia.js, Vue 3, and Tailwind CSS for the best development experience</p>
          </div>
        </div>

        <!-- About Project -->
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-3xl mx-auto text-center">
          <h2 class="text-2xl font-bold mb-4">About This Project</h2>
          <p class="text-gray-600 mb-4">
            This application was developed as a technical assessment, demonstrating the ability to handle large datasets.
          </p>
          <p class="text-sm text-gray-500">
            Created using modern web technologies
          </p>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Layout from '../Layouts/Layout.vue'
</script>
