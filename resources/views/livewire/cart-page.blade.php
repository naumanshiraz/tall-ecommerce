<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
    <div class="flex flex-col md:flex-row gap-4">
      <div class="md:w-3/4">
        <div class="bg-white rounded-lg shadow-md p-6 mb-4">
          <table class="w-full">
            <thead>
              <tr>
                <th class="text-left font-normal text-black-700">Product</th>
                <th class="text-left font-normal text-black-700">Price</th>
                <th class="text-left font-normal text-black-700">Quantity</th>
                <th class="text-left font-normal text-black-700">Total</th>
                <th class="text-left font-normal text-black-700">Remove</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($cart_items as $item)
                <tr wire:key="{{ $item['product_id'] }}">
                  <td class="py-4">
                    <div class="flex items-center">
                      <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">

                      <div class="relative group max-w-[200px]">
                          <span class="block truncate cursor-pointer">
                              {{ $item['name'] }}
                          </span>

                          <div class="absolute left-0 bottom-full mb-2 hidden group-hover:block 
                                      bg-gray-900 text-white text-xs rounded px-2 py-1 
                                      whitespace-wrap z-10 max-w-[250px]">
                              {{ $item['name'] }}
                          </div>
                      </div>
                    </div>
                  </td>
                  <td class="py-4">{{ Number::currency($item['unit_amount'], 'PKR')}}</td>
                  <td class="py-4">
                    <div class="flex items-center">
                      <button wire:click="decreaseQty({{ $item['product_id'] }})" class="border rounded-md px-2 mr-2">-</button>
                      <span class="text-center">{{ $item['quantity'] }}</span>
                      <button wire:click="increaseQty({{ $item['product_id'] }})" class="border rounded-md px-2 ml-2">+</button>
                    </div>
                  </td>
                  <td class="py-4">{{ Number::currency($item['total_amount'], 'PKR')}}</td>
                  <td>
                    <button wire:click="removeItem({{ $item['product_id'] }})" 
                      class="bg-slate-300 border-slate-400 rounded-lg px-2 py-1 
                      hover:bg-red-500 hover:text-white hover:border-red-700">
                      <span wire:loading.remove="" wire:target="removeItem({{ $item['product_id'] }})">Remove</span>
                      <span wire:loading wire:target="removeItem({{ $item['product_id'] }})">Remove</span>
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="py-4">
                    <span class="text-red-600 text-center py-4 block font-semibold">Cart is empty!</span>
                  </td>
                </tr>
              @endforelse
              
              <!-- More product rows -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="md:w-1/4">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-lg mb-4">Summary</h2>
          <div class="flex justify-between mb-2">
            <span>Subtotal</span>
            <span>{{ Number::currency($grand_total, 'PKR')}}</span>
          </div>
          <div class="flex justify-between mb-2">
            <span>Taxes</span>
            <span>{{ Number::currency(0, 'PKR') }}</span>
          </div>
          <div class="flex justify-between mb-2">
            <span>Shipping</span>
            <span>{{ Number::currency(0, 'PKR') }}</span>
          </div>
          <hr class="my-2">
          <div class="flex justify-between mb-2">
            <span class="font-semibold">Total</span>
            <span class="font-semibold">{{ Number::currency($grand_total, 'PKR')}}</span>
          </div>
          @if($cart_items)
            <a href="/checkout" class="block text-center bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>