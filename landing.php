<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RegrowUp - Empower Your Growth</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>

  <style>
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
<body class="bg-white text-gray-800 flex flex-col min-h-screen">

  <!-- Header -->
  <header class="fixed top-0 left-0 w-full bg-white shadow z-50">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
      <a href="#" class="text-2xl font-bold text-red-600">RegrowUp</a>
      <nav class="space-x-4">
        <a href="#services" class="hover:text-red-600">Services</a>
        <a href="#about" class="hover:text-red-600">About</a>
        <a href="#contact" class="hover:text-red-600">Contact</a>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex-grow mt-20 relative z-10">

    <!-- Hero -->
    <section class="relative min-h-[90vh] flex flex-col justify-center items-center text-center px-6 bg-white overflow-hidden">
      <div id="tsparticles" class="absolute inset-0 z-0"></div>

      <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight text-gray-900 z-10" data-aos="fade-up">RegrowUp</h1>
      <p class="text-xl md:text-2xl mb-8 max-w-2xl text-gray-700 z-10" data-aos="fade-up" data-aos-delay="200">
        Building scalable, intelligent software solutions that grow with your business needs.
      </p>
      <a href="#contact" class="bg-red-600 text-white px-8 py-4 rounded-full shadow-lg hover:bg-red-700 transition transform hover:scale-105 z-10" data-aos="zoom-in" data-aos-delay="400">
        Let's Talk
      </a>
    </section>

    <!-- Services -->
    <section id="services" class="py-20 px-6 bg-white">
      <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-12" data-aos="fade-up">Our Services</h2>
        <div class="grid md:grid-cols-3 gap-10">
          <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-2xl font-semibold mb-4">Custom Software</h3>
            <p>Tailored digital solutions for startups, enterprises, and everything in between. Built with scalability and precision.</p>
          </div>
          <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-2xl font-semibold mb-4">Web & Mobile Apps</h3>
            <p>Elegant, intuitive, cross-platform applications that provide amazing user experiences across devices.</p>
          </div>
          <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
            <h3 class="text-2xl font-semibold mb-4">Tech Consulting</h3>
            <p>Expert guidance, architectural advice, code audits, scaling strategies, and tech leadership for your teams.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- About -->
    <section id="about" class="py-20 px-6 bg-white">
      <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-8" data-aos="fade-up">Why Choose RegrowUp?</h2>
        <p class="text-lg mb-6 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
          We are a lean, passionate team focused on delivering powerful, sustainable, and elegant software solutions.  
          Whether you're starting fresh or scaling massively, RegrowUp ensures your technology evolves with you.
          <br> We are located at #200, 997 Seymour St, Vancouver, BC V6B 3M1, Canada.
          
        </p>
      </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="py-20 px-6 bg-white text-gray-800">
      <div class="max-w-xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-6" data-aos="fade-up">Get in Touch</h2>
        <p class="mb-8 text-lg" data-aos="fade-up" data-aos-delay="200">We would love to hear about your project, ideas, and goals.</p>
        <form action="contact.php" method="POST" class="space-y-4" data-aos="fade-up" data-aos-delay="400">
          <input type="text" name="name" placeholder="Your Name"
                 class="w-full px-4 py-3 rounded text-gray-800 bg-white border border-gray-300 focus:ring-4 focus:ring-red-300 focus:border-red-500 transition duration-300"
                 required>
          <input type="email" name="email" placeholder="Your Email"
                 class="w-full px-4 py-3 rounded text-gray-800 bg-white border border-gray-300 focus:ring-4 focus:ring-red-300 focus:border-red-500 transition duration-300"
                 required>
          <textarea name="message" rows="4" placeholder="Your Message"
                    class="w-full px-4 py-3 rounded text-gray-800 bg-white border border-gray-300 focus:ring-4 focus:ring-red-300 focus:border-red-500 transition duration-300"
                    required></textarea>
          <button type="submit" class="w-full bg-red-600 text-white px-6 py-3 rounded-full shadow hover:bg-red-700 transition">
            Send Message
          </button>
        </form>
      </div>
        <!-- Footer -->
  <footer class="py-8 text-center text-gray-600 bg-gray-100">
    © 2025 RegrowUp. All rights reserved. 
  </footer>
    </section>

  </main>



  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ once: true });
  </script>
  <script>
    tsParticles.load("tsparticles", {
      background: { color: { value: "#ffffff" } },
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
        color: { value: "#EF4444" },
        links: {
          color: "#EF4444",
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
