<div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $story->title)}}" placeholder="Enter Title">

    <x-form-error field='title'/>
</div>

<div class="form-group">
    <label for="body">Body:</label>
    <textarea class="form-control @error('body') is-invalid @enderror" name="body" placeholder="Enter Content">{{old('body', $story->body)}}</textarea>
     <x-form-error field='body'/>
</div>

<div class="form-group">
    <label for="type">Type:</label>
        <select name="type" id="" class="form-control @error('type') is-invalid @enderror">
            <option value="">Choose Type</option>
            <option value="short" {{'short' == old('type', $story->type) ? 'selected' : ''}}>Short</option>
            <option value="long" {{'long' == old('type', $story->type) ? 'selected' : ''}}>Long</option>
        </select>
        <x-form-error field='type'/>
 </div>
 <br>
 <div class="form-group">
     <legend>
         <h6>Status</h6>
     </legend>
    <div class="form-check @error('status') is-invalid @enderror">
        <input type="radio" class="form-check-input" name="status" value="1" {{'1' == old('status', $story->status) ? 'checked' : ''}}>
        <label for="Active" class="form-check-label">Yes</label>
    </div>

    <div class="form-check">
        <input type="radio" class="form-check-input" name="status" value="0" {{'0' == old('status', $story->status) ? 'checked' : ''}}>
        <label for="Active" class="form-check-label">No</label>
    </div>

    <x-form-error field='status'/>
 </div>
<br>

<div class="form-group">
    <label for="image">Image:</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

    <x-form-error field='image'/>
    <img src="{{$story->thumbnail}}" alt="">
</div>

<div class="form-group">
    @foreach($tags as $tag)
    <div class="form-check form-check-inline">
        <input type="checkbox" class="form-check-input" name="tags[]" value="{{$tag->id}}"
        {{in_array($tag->id, old('tags', $story->tags->pluck('id')->toArray())) ? 'checked' : ''}}
        >
        <label for="tag" class="form-check-label">{{$tag->name}}</label>
    </div>
    @endforeach
</div>
