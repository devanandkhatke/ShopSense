<footer class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- Brand --}}
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">
                    ShopSense
                </h3>
                <p class="text-sm text-gray-600">
                    A modern multi-vendor marketplace connecting sellers and customers.
                </p>
            </div>

            {{-- Shop --}}
            <div>
                <h4 class="font-semibold text-gray-800 mb-3">Shop</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><a href="{{ route('shop.index') }}" class="hover:text-black">All Products</a></li>
                    <li><a href="#" class="hover:text-black">New Arrivals</a></li>
                    <li><a href="#" class="hover:text-black">Best Sellers</a></li>
                </ul>
            </div>

            {{-- Sellers --}}
            <div>
                <h4 class="font-semibold text-gray-800 mb-3">Sellers</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    @guest
                    <li><a href="{{ route('register') }}" class="hover:text-black">Become a Seller</a></li>
                    @endguest
                    <li><a href="#" class="hover:text-black">Seller Guidelines</a></li>
                    <li><a href="#" class="hover:text-black">Support</a></li>
                </ul>
            </div>

            {{-- Legal --}}
            <div>
                <h4 class="font-semibold text-gray-800 mb-3">Legal</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><a href="#" class="hover:text-black">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-black">Terms & Conditions</a></li>
                    <li><a href="#" class="hover:text-black">Refund Policy</a></li>
                </ul>
            </div>

        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-200 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center">

            <p class="text-sm text-gray-500">
                © {{ date('Y') }} ShopSense. All rights reserved.
            </p>

            {{-- Social --}}
            <div class="flex gap-4 mt-4 md:mt-0 text-gray-600">

                <a href="#" class="hover:text-black" aria-label="Facebook">
                    🌐
                </a>

                <a href="#" class="hover:text-black" aria-label="Twitter">
                    🐦
                </a>

                <a href="#" class="hover:text-black" aria-label="Instagram">
                    📸
                </a>

            </div>

        </div>

    </div>
</footer>