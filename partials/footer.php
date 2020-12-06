<div class="container-fluid mt-2">
    <div class="row" id="infoPanes" style="display: none;">

        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">
                    <!-- <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#home" class="nav-link active" data-toggle="tab">Source code</a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile" class="nav-link" data-toggle="tab">Input Data</a>
                        </li>
                    </ul> -->

                    <!-- Pills -->

                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a href="#home" class="nav-link active" data-toggle="tab" id="DisplaySource">Source code</a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile" class="nav-link" data-toggle="tab" id="DisplayData"> Input Data</a>
                        </li>
                    </ul>
                </h5>
                <div class="card-body">
                    <div class="tab-content">
                        <code class="code tab-pane fade show active" id="home">
                            <textarea class="codemirror-textarea" id="ed_code"></textarea>
                            <?php
                            // $source = show_source(__DIR__ . "/../tasks/" . $_GET["file"], true);
                            // echo($source);
                            ?>
                            </textarea>
                        </code>
                        <code class="code tab-pane fade" id="profile">
                            <?php
                            echo (implode("<br>", $_GET['input']));
                            ?>
                        </code>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">
                    <!-- <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#home" class="nav-link active" data-toggle="tab">Source code</a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile" class="nav-link" data-toggle="tab">Input Data</a>
                        </li>
                    </ul> -->

                    <!-- Pills -->

                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#home">Output</a>
                        </li>
                    </ul>
                </h5>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="code tab-pane fade show active" id="home">
                            <?php
                            echo (json_encode($_GET["output"]));
                            echo ("<hr>");
                            echo ("<small style='font-size:11px' class=\"text-info\">");
                            echo ("<br>" . $_GET["codeLength"] . " lines of code");
                            echo ("<br>" . $_GET["dataLength"] . " rows of input data");
                            echo ("<br>Executed in " . number_format($_GET["elapsed_time"] * 1000, 1)  . " µs");

                            echo ("</small>");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#infoPanes').fadeIn(1200);
</script>