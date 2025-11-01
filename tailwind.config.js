/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/**/*.blade.php",
    "./resources/views/**/*.blade.php", 
  ],
  theme: {
    extend: {
      colors: {
        primary: '#C75513',      // Merah Maroon
        'primary-dark': '#972B2B', // Merah Maroon lebih gelap
        'primary-light': '#A52A2A', // Merah Maroon lebih terang
        secondary: '#333333',     // Abu-abu gelap mendekati hitam
        gold: '#D4AF37',         // Emas
        'gold-light': '#E6C35C', // Emas lebih terang
        light: '#f8f8f8',        // Putih sangat terang
        dark: '#1a1a1a',         // Hitam pekat
        
        // --- PERUBAHAN PENTING DI SINI ---
        // Ganti warna glasses menjadi transparan
        glasses: 'rgba(255, 255, 255, 0.15)',  // Background bening
        'glasses-border': 'rgba(255, 255, 255, 0.3)', // Border bening
      },
      fontFamily: {
        inter: ['Inter', 'sans-serif'],
        sora: ['Sora', 'sans-serif'],
      },
      backgroundImage: {
        'gradient-primary': 'linear-gradient(135deg, #800000 0%, #1a1a1a 100%)',
        'gradient-gold': 'linear-gradient(135deg, #D4AF37 0%, #800000 100%)',
      },
      boxShadow: {
        'card': '0 8px 20px rgba(0,0,0,0.08)',
        'card-hover': '0 12px 25px rgba(0,0,0,0.15)',
        'button': '0 4px 12px rgba(128, 0, 0, 0.25)',
        'button-hover': '0 8px 20px rgba(128, 0, 0, 0.35)',
      },
      animation: {
        'fade-in-up': 'fadeInUp 0.6s ease forwards',
      },
      keyframes: {
        fadeInUp: {
          '0%': { opacity: '0', transform: 'translateY(30px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        }
      }
    },
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
  ],
}