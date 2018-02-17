<div id="newEvent" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="{{ route('event.save') }}" method="POST">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Event</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title" tabindex="1">
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" placeholder="Description"
                                  tabindex="1"></textarea>
                    </div>
                    <div class="form-group">
                        <textarea name="address" class="form-control" placeholder="Address"
                                  tabindex="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start">Start Date : dd-mm-yyyy HH:mm (24 hrs)</label>
                        <input type="text" name="start" placeholder="dd-mm-yyyy HH:mm (24 hrs)"
                               class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="start">End Date : dd-mm-yyyy HH:mm (24 hrs)</label>
                        <input type="text" name="end" placeholder="dd-mm-yyyy HH:mm (24 hrs)"
                               class="form-control"/>
                    </div>
                    <div class="form-group">
                        <select name="category_id" id="category" tabindex="2" class="form-control">
                            <option value="category">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="interest_id" id="areaofinterest" tabindex="2" class="form-control">
                            <option value="-1">Select Area Of Interest</option>
                            @foreach($interests as $interest)
                                <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="POST" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>