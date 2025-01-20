import Link from 'next/link'
import Image from 'next/image'
import { BsArrowRight } from 'react-icons/bs';

const Footer = () => {
    return (
        <footer className="bg-black text-white py-12">
            <div className="max-w-7xl mx-auto  flex flex-col">

                {/* Top Section with 3 Columns */}
                <div className="flex justify-between mb-16">
                    {/* Logo Column */}
                    <div className="flex-1">
                        <Link href="https://deepskyblue-porpoise-325671.hostingersite.com/">
                            <Image
                                src="/images/logo.png"
                                alt="Startup IQ Logo"
                                width={250}
                                height={50}
                                className="object-contain"
                            />
                        </Link>
                    </div>

                    {/* Newsletter Column */}
                    <div className="flex-1 px-20">
                        <h3 className="text-xl font-medium mb-4">Newsletter signup</h3>
                        <div className="flex items-center border-b border-startup-iq-green">
                            <input
                                type="email"
                                placeholder="✉ Enter your Email"
                                className="bg-transparent border-none outline-none flex-1 text-white"
                            />
                            <button className="p-2 text-startup-iq-green">
                                <BsArrowRight size={20} />
                                
                            </button>
                        </div>
                    </div>

                    {/* Contact Column */}
                    <div className="flex-1 justify-center text-center">
                        <h3 className="text-xl font-medium mb-4">Contact Us</h3>
                        <p className="mb-4">Got Questions? Contact Us and Accelerate Your Success!</p>
                        <button className="bg-startup-iq-green text-white px-6 py-2 rounded-full">
                            Get In Touch
                        </button>
                    </div>
                </div>

                {/* Bottom Section */}
                <div className="flex justify-between items-center pt-8 border-t border-gray-800">
                    <p className="text-sm">Startup IQ © 2025. All Rights Reserved.</p>
                    <div className="flex gap-8">
                        <a
                            href="https://deepskyblue-porpoise-325671.hostingersite.com/privacy-policy/"
                            className="text-sm hover:text-startup-iq-green"
                        >
                            Privacy Policy
                        </a>
                        <a
                            href="https://deepskyblue-porpoise-325671.hostingersite.com/terms-and-conditions"
                            className="text-sm hover:text-startup-iq-green"
                        >
                            Terms & Conditions
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    )
}

export default Footer
