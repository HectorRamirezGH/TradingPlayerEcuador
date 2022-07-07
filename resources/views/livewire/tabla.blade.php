<div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden shadow border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full">
          <thead class="border-b bg-gray-800">
            <tr>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                name
              </th>
              @foreach ($caracteristicas as $carac)
              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                {{$carac->name}}
              </th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($coleccionables as $c)
            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              {{ $c->name }}
              </td>  
              @foreach ($caracteristicascoleccionable as $cc)
                @if($cc->coleccionable == $c->id)
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $cc->value }}
                </td>
                @endif
              @endforeach
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>