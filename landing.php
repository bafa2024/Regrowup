<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RegrowUp - Empower Your Growth</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>

  <style>
    html {
      scroll-behavior: smooth;
    }
    .float-anim {
      animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
      100% { transform: translateY(0px); }
    }
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- Hero Section -->
  <section class="relative min-h-screen flex flex-col justify-center items-center text-center px-6 bg-gray-900 overflow-hidden">
    
    <!-- tsParticles Canvas -->
    <div id="tsparticles" class="absolute inset-0"></div>

    <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight text-white z-10">RegrowUp</h1>
    <p class="text-xl md:text-2xl mb-8 max-w-2xl text-white z-10">
      Building scalable, intelligent software solutions that grow with your business needs.
    </p>
    <a href="#contact" class="bg-blue-600 text-white px-8 py-4 rounded-full shadow-lg hover:bg-blue-700 transition transform hover:scale-105 z-10">
      Let's Talk
    </a>
  </section>

  <!-- Services Section -->
  <section class="py-20 px-6 bg-gray-50">
    <div class="max-w-6xl mx-auto text-center">
      <h2 class="text-4xl font-bold mb-12">Our Services</h2>
      <div class="grid md:grid-cols-3 gap-10">
        <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition transform hover:-translate-y-2">
          <h3 class="text-2xl font-semibold mb-4">Custom Software</h3>
          <p>Tailored digital solutions for startups, enterprises, and everything in between. Built with scalability and precision.</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition transform hover:-translate-y-2">
          <h3 class="text-2xl font-semibold mb-4">Web & Mobile Apps</h3>
          <p>Elegant, intuitive, cross-platform applications that provide amazing user experiences across devices.</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition transform hover:-translate-y-2">
          <h3 class="text-2xl font-semibold mb-4">Tech Consulting</h3>
          <p>Expert guidance, architectural advice, code audits, scaling strategies, and tech leadership for your teams.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section class="py-20 px-6 bg-white">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-4xl font-bold mb-8">Why Choose RegrowUp?</h2>
      <p class="text-lg mb-6 leading-relaxed">
        We are a lean, passionate team focused on delivering powerful, sustainable, and elegant software solutions.  
        Whether you're starting fresh or scaling massively, RegrowUp ensures your technology evolves with you.
      </p>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="py-20 px-6 bg-blue-600 text-white">
    <div class="max-w-xl mx-auto text-center">
      <h2 class="text-4xl font-bold mb-6">Get in Touch</h2>
      <p class="mb-8 text-lg">We would love to hear about your project, ideas, and goals.</p>
      <form action="mailto:hello@regrowup.com" method="POST" enctype="text/plain" class="space-y-4">
        <input 
          type="text" 
          name="name" 
          placeholder="Your Name" 
          class="w-full px-4 py-3 rounded text-gray-800 bg-white border border-gray-300 focus:ring-4 focus:ring-blue-300 focus:border-blue-500 transition duration-300"
          required
        >
        <input 
          type="email" 
          name="email" 
          placeholder="Your Email" 
          class="w-full px-4 py-3 rounded text-gray-800 bg-white border border-gray-300 focus:ring-4 focus:ring-blue-300 focus:border-blue-500 transition duration-300"
          required
        >
        <textarea 
          name="message" 
          rows="4" 
          placeholder="Your Message" 
          class="w-full px-4 py-3 rounded text-gray-800 bg-white border border-gray-300 focus:ring-4 focus:ring-blue-300 focus:border-blue-500 transition duration-300"
          required
        ></textarea>
        <button type="submit" class="w-full bg-white text-blue-600 px-6 py-3 rounded-full shadow hover:bg-gray-200 transition">
          Send Message
        </button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-8 text-center text-gray-600 bg-gray-100">
    © 2025 RegrowUp. All rights reserved.
  </footer>

  <!-- tsParticles Config -->
  <script>
    tsParticles.load("tsparticles", {
      background: {
        color: { value: "#111827" }
      },
      fpsLimit: 60,
      interactivity: {
        events: {
          onClick: { enable: true, mode: "push" },
          onHover: { enable: true, mode: "repulse" },
          resize: true
        },
        modes: {
          push: { quantity: 4 },
          repulse: { distance: 100, duration: 0.4 }
        }
      },
      particles: {
        color: { value: "#60A5FA" },
        links: {
          color: "#60A5FA",
          distance: 150,
          enable: true,
          opacity: 0.5,
          width: 1
        },
        collisions: { enable: false },
        move: {
          direction: "none",
          enable: true,
          outModes: "bounce",
          random: false,
          speed: 2,
          straight: false
        },
        number: {
          density: { enable: true, area: 800 },
          value: 60
        },
        opacity: { value: 0.5 },
        shape: { type: "circle" },
        size: { value: { min: 1, max: 5 } }
      },
      detectRetina: true
    });
  </script>

</body>
</html>
