<div wire:poll>  
    <div class="flex">
        <div class="flex-col">
            <div class="bg-white px-4 py-3 sm:px-6">
                <input type="search" class="rounded-md border-gray-200 shadow-md mt-1 block w-full" name="search" placeholder="Search" required />
            </div>
                
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <h2 class="my-2 mb-2 ml-2 text-lg text-gray-600">Chats</h2>
                <ul class="bg-white mb-2 py-3 border-t rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-80">            
                @foreach ($users as $item)
                    <li class="py-2 hover:bg-gray-100 rounded-lg px-2" type="button" wire:click="startChat({{ $item->id }})">
                        @php
                        // get notifcations/un read messages
                        $notifications = App\Models\Message::where('is_read', '0')->where('sender_id', $item->id)->get();
                        @endphp
                        <div class="flex">
                            <div class="flex flex-col">
                                <img class="h-10 w-10 shadow-md rounded-full object-cover" src="{{ $item->profile_photo_url }}" alt="{{ $item->name }}" />
                            </div>
                            <div class="flex flex-col px-4">
                                <strong style="text-transform:capitalize">{{ $item->name }}
                                    @if ($notifications->count() > 0)
                                    <small><span class="badge badge-danger text-light float-right mt-2">{{ $notifications->count() }}</span></small>
                                    @endif
                                </strong>
                                @if (Cache::has('is_online' . $item->id))
                                <div class="small"><span class="fa fa-circle chat-online"></span> Online</div>
                                @else
                                <div class="small">Last seen: {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}</div>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>      
        </div>
        @if ($noChat)
        <div class="flex-1">
            <div class="bg-white px-4 py-1 sm:px-6">
                
                <div class="flex border-b">
                    <div class="flex flex-col bg-white py-3 sm:px-6">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $current->profile_photo_url }}" alt="{{ $current->name }}" />
                    </div>
                    <div class="flex flex-col bg-white py-1">
                        <span class="badge badge-danger text-light float-right mt-2"><strong>{{ $current->name }}</strong></span>
                        @if (Cache::has('is_online' . $current->id))
                        <div class="text-green-500"> 
                        <small>Online</small></div>
                        @else
                        <div class="text-red-500">
                            <small>Last seen: {{ \Carbon\Carbon::parse($current->last_seen)->diffForHumans() }} </small></div>
                        @endif
                    </div>
                </div>
                <div class="flex-col w-full overflow-y-auto py-4 h-72">              
                    @if ($messages->count())
                        @foreach ($messages as $chat)
                        @if ($chat->sender_id == Auth::user()->id && $chat->receiver_id == $receiver)
                        <div class="flex bg-white justify-end px-4 py-3 sm:px-6">
                            @if ($chat->message == '0')
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                <small class="text-muted" style="font-style: italic;">Message Deleted</small>
                            </div>
                            @else
                            <div class="flex shadow-lg border border-gray-100 rounded-lg p-2 sm:px-6">
                                <p class="max-w-xs normal overflow-hidden text-md">
                                    {{ $chat->message }}
                                </p>
                                <div class="flex">
                                    <small class="ml-4 place-self-end text-xs">Enviado {{ date('h:i a', strtotime($chat->created_at)) }}</small>
                                </div>
                            </div>
                            @endif
                        </div>
                        @elseif($chat->sender_id == $receiver && $chat->receiver_id == Auth::user()->id)
                        <div class="flex bg-white px-4 py-3 sm:px-6">
                            @if ($chat->message == '0')
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                <small class="text-muted" style="font-style: italic;">Message Deleted</small>
                            </div>
                            @else
                            <div class="flex shadow-lg border border-gray-100 rounded-lg p-2 sm:px-6">
                                <p class="max-w-xs normal overflow-hidden text-md">
                                    {{ $chat->message }}
                                </p>
                                <div class="flex">
                                    <small class="ml-4 place-self-end text-xs">Enviado {{ date('h:i a', strtotime($chat->created_at)) }}</small>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                        @endforeach
                    @else
                        <div class="flex bg-white px-4 py-3 justify-center sm:px-6">
                            <p class="pt-8 text-xl">{{ __('Start the chat with your friend!') }}</p>
                        </div>
                    @endif               
                </div>
                <div class="flex-grow-0 py-6 px-4">
                    <form wire:submit.prevent="sendChat">
                    @csrf
                        <div class="input-group">
                            <input type="hidden" value="{{ $receiver }}" wire:model.defer="receiver_id">
                            <input autofocus type="text" class="@error('message') is-invalid @enderror rounded-md border-gray-200 shadow-md mt-1 block w-full" wire:model.defer="message" placeholder="Type your message"/>
                            @error('message')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                              
            </div>
        </div>
        @endif
    </div>
</div>