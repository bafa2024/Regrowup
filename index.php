<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RegrowUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Subtle floating animation */
    .float-anim {
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-15px); }
      100% { transform: translateY(0px); }
    }
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- Hero Section -->
  <section class="relative min-h-screen flex flex-col justify-center items-center text-center px-6 bg-gradient-to-br from-blue-100 to-white overflow-hidden">
    
    <!-- Animated Background Shapes -->
    <svg class="absolute top-0 left-0 w-64 h-64 opacity-20 text-blue-300 float-anim" fill="currentColor" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="10"></circle>
    </svg>
    <svg class="absolute bottom-10 right-10 w-48 h-48 opacity-20 text-pink-300 float-anim delay-1000" fill="currentColor" viewBox="0 0 24 24">
      <rect x="4" y="4" width="16" height="16" rx="4"></rect>
    </svg>

    <h1 class="text-4xl md:text-6xl font-bold mb-4">RegrowUp</h1>
    <p class="text-lg md:text-xl mb-6 max-w-xl">We build scalable, smart software that grows with your business.</p>
    <a href="#contact" class="bg-blue-600 text-white px-6 py-3 rounded-full shadow hover:bg-blue-700 transition">Let's Talk</a>
  </section>

  <!-- Services Section -->
  <section class="py-16 px-6 bg-gray-50">
    <div class="max-w-6xl mx-auto text-center">
      <h2 class="text-3xl font-semibold mb-8">Our Services</h2>
      <div class="grid md:grid-cols-3 gap-8 text-left">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg">
          <h3 class="text-xl font-bold mb-2">Custom Software Development</h3>
          <p>Tailored applications built to power your business with precision and speed.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg">
          <h3 class="text-xl font-bold mb-2">Web & Mobile Apps</h3>
          <p>Responsive, elegant, and user-centered applications for every platform.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg">
          <h3 class="text-xl font-bold mb-2">Tech Consulting & Support</h3>
          <p>Scalable architectures, audits, and on-demand development expertise.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section class="py-16 px-6 bg-white">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-3xl font-semibold mb-6">Why RegrowUp?</h2>
      <p class="text-lg mb-4">We're a lean, dedicated team that delivers efficient and elegant software solutions, ready to evolve with your goals.</p>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="py-16 px-6 bg-blue-600 text-white">
    <div class="max-w-xl mx-auto text-center">
      <h2 class="text-3xl font-semibold mb-4">Get in Touch</h2>
      <p class="mb-6">Have a project in mind? Let's build something great together.</p>
      <a href="mailto:hello@regrowup.com" class="bg-white text-blue-600 px-6 py-3 rounded-full shadow hover:bg-gray-200 transition">Email Us</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-6 text-center text-sm text-gray-500 bg-gray-100">
    © 2025 RegrowUp. All rights reserved.
  </footer>

</body>
</html>
