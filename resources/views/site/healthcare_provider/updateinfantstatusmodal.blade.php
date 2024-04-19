<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/healthcare_provider/updateStatus" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="hidden" id="schedule_id" name="schedule_id" value="{{$schedule->id}}">
                            <select name="status" id="status" class="form-control">
                                <option value="" selected disabled hidden>Update Status here</option>
                                <option value="done">Done</option>
                                <option value="pending">Pending</option>
                            </select>
                            <br>
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" placeholder="Remarks" class="form-control" id="remarks" cols="30" rows="5"
                                style="resize: none"></textarea>
                            <br>
                            <label for="password">Password</label>
                            <input type="password" placeholder="Password" id="password" name="password"
                                class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>