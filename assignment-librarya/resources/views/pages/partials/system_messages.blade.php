@if(!empty($systemMessage) && array_key_exists('created', $systemMessage))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
            {{ $systemMessage['created'] }}
    </div>
@endif

@if(!empty($systemMessage) && array_key_exists('updated', $systemMessage))
    <div class="alert alert-warning" role="alert">
        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
            {{ $systemMessage['updated'] }}
    </div>
@endif