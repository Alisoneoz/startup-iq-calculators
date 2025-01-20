import Link from 'next/link'
import Image from 'next/image'

const Navbar = () => {
  return (
    <nav className="w-full bg-white shadow-sm">
      <div className="max-w-7xl mx-auto flex items-center px-[100px] py-4">
        {/* Logo */}
        <div className="flex-shrink-0">
          <Link href="https://deepskyblue-porpoise-325671.hostingersite.com/">
            <Image 
              src="/images/logo.png" 
              alt="Logo" 
              width={150}
              height={50}
              className="object-contain"
            />
          </Link>
        </div>

        {/* Centered Navigation Links */}
        <div className="flex-grow flex items-center justify-center gap-8">
          <a 
            href="https://deepskyblue-porpoise-325671.hostingersite.com/" 
            className="text-gray-700 hover:text-startup-iq-green"
          >
            Home
          </a>
          <a 
            href="https://deepskyblue-porpoise-325671.hostingersite.com/about" 
            className="text-gray-700 hover:text-startup-iq-green"
          >
            About
          </a>
          <a 
            href="https://deepskyblue-porpoise-325671.hostingersite.com/contact" 
            className="text-gray-700 hover:text-startup-iq-green"
          >
            Contact
          </a>
          <a 
            href="https://startup-iq-calculators.netlify.app/" 
            className="text-gray-700 hover:text-startup-iq-green"
          >
            Calculators
          </a>
          <a 
            href="https://deepskyblue-porpoise-325671.hostingersite.com/blog" 
            className="text-gray-700 hover:text-startup-iq-green"
          >
            Blog
          </a>
        </div>
      </div>
    </nav>
  )
}

export default Navbar
