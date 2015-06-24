<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    {$ERROR_CODE}| {$MESSAGE} </h2>
                <div class="error-details">
                    {$DETAILS}
                </div>
                <div class="error-actions">
                    <a href="/" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-home"></span>
                        Take Me Home </a><a href="mailto:andreas@linx.ninja" class="btn btn-default btn-lg">
                        <span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                </div>
            </div>
        </div>
    </div>
</div>
{$BODY_ASSET_TAGS}