<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div class="w-full p-5 bg-white mb-2 mr-2 rounded border" id="reply-{{ $reply->id}}">
        <div class="mb-2 border-b pb-2 flex justify-between items-center">
            <span>{{ $reply->owner->name }} said {{ $reply->created_at->diffForHumans() }}</span>
            <favorite :reply="{{ $reply }}"></favorite>
        </div>
        <div class="mb-3" v-if="!editing" v-text="body"></div>
        <div v-else class="text-right">
            <textarea class="w-full border rounded p-4" v-model="body"></textarea>

            <button class="p-1 text-xs border border-blue-400 text-blue-400 rounded mt-4 "
                @click="editing = false">Cancel</button>
            <button class="p-1 text-xs bg-blue-400 text-white rounded mt-4 mr-2" @click="update">Update</button>

        </div>
        @can('update', $reply)
        <div class="flex">
            <button class="p-1 text-xs bg-blue-400 text-white rounded mt-4 mr-2" @click="editing = true">Edit</button>
            <button class="p-1 text-xs bg-red-400 text-white rounded mt-4" @click="destroy">Delete</button>
        </div>
        @endcan
    </div>


</reply>
