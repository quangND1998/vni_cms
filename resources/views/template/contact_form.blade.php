<span class="title_form">{{__($section->title)}}</span>


<div class="form_contact">
    <form id="contact-form" method="POST" action="{{ route('contact.store') }}" novalidate="novalidate">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <input type="text" name="name" id="message_name" class="form-control" placeholder="Your Name">
            @if ($errors->has('name'))
            <span class="text-red">
                <P class="text-danger">{{ $errors->first('name') }}</P>
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <input type="text" name="email" id="message_email" class="form-control" placeholder="Email Address">
            @if ($errors->has('email'))
            <span class="text-red">
                <P class="text-danger">{{ $errors->first('email') }}</P>
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
            <input type="text" name="phone" id="message_phone" class="form-control" placeholder="Number Phone">
            @if ($errors->has('phone'))
            <span class="text-red">
                <P class="text-danger">{{ $errors->first('phone') }}</P>
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
            <textarea class="form-control" name="message" id="message_message" placeholder="Your Message" rows="5"
                cols="4"></textarea>
            @if ($errors->has('phmessageone'))
            <span class="text-red">
                <P class="text-danger">{{ $errors->first('message') }}</P>
            </span>
            @endif
        </div>
        <div style="text-align:center">
            <button type="submit" class="btn btn-cta text-uppercase" style="">{{__($section->sub_title)}}</button>
        </div>

    </form>
</div>