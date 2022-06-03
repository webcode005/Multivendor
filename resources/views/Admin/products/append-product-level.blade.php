
    <select name="parent" class="form-control" required>
        <option value="">Select Category Level</option>
            @if(!empty($getCategories))

                @foreach($getCategories as $categories)

                <option value="{{$categories['id']}}" @if(isset($category['parent_id']) && $category['parent_id']== $category['id'])  selected=""  @endif >{{$categories['category_name']}}</option>

                    @if(!empty($category['subCategories']))

                        @foreach($category['subCategories'] as $subcategory)

                        <option value="{{$subcategory['id']}}" @if(isset($category['parent_id']) && $category['parent_id']== $subcategory['id'])  selected=""  @endif > &nbsp; &raquo; &nbsp; {{$subcategory['category_name']}}</option>

                        @endforeach

                    @endif 

                @endforeach

            @endif                                

        
    
    </select>
