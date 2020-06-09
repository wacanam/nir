<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Neural Network Based Durian Fruit Maturity and Ripeness Evaluator Employing Near-Infrared (NIR) Spectral Sensor">
    <title>Durian Fruit Maturity and Ripeness Evaluator </title>
    <link rel="shortcut icon" href="/assets/icon/scan.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="/assets/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="/assets/css/normalize.min.css"> -->
    <link rel="stylesheet" href="./assets/css/w3.css">
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">

    <script src="./assets/js/Chart.min.js"></script>
    <script src="./assets/js/jquery.min.js"></script>
    <!-- <script src="./assets/js/fontawesome.min.js"></script> -->
    <script src="./assets/js/tf.min.js"></script>
    <!-- <script src="/assets/js/jquery-ui.min.js"></script> -->

</head>

<body onload="javascript:connect()">

    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-green" style="width:225px;" id="mySidebar">
        <button class="w3-bar-item w3-button w3-hide-large w3-right-align" id="home_tab" onclick="w3_close()"><b>&times;</b></button>
        <button href="#" class="w3-bar-item w3-button w3-large w3-wide"><i class="fa fa-home"></i>&nbsp;Home</button>
        <button href="#" class="w3-bar-item w3-button w3-large w3-wide" id="login_tab" onclick="document.getElementById('login').style.display ='block'"><i class="fa fa-sign-in"></i>&nbsp;Login</button>
        <button href="#" class="w3-bar-item w3-button w3-large w3-wide" id="data_tab"><i class="fa fa-file"></i>&nbsp;Data</button>
        <button href="#" class="w3-bar-item w3-button w3-large w3-wide" id="scan_tab"><i class="fa fa-search"></i>&nbsp;Scanner</button>
        <button href="#" class="w3-bar-item w3-button w3-large w3-wide" id="labeling_tab" onclick="document.getElementById('labeling').style.display ='block'"><i class="fa fa-edit"></i>&nbsp;Labeling</button>
        <button href="#" class="w3-bar-item w3-button w3-large w3-wide" id="train_tab" onclick="document.getElementById('trainning').style.display ='block'"><i class="fa fa-refresh"></i>&nbsp;Train</button>
        <button href="#" class="w3-bar-item w3-button w3-large w3-wide" id="report_tab" onclick="document.getElementById('report').style.display ='block'"><i class="fa fa-print"></i>&nbsp;Report</button>
        <button href="#" class="w3-bar-item w3-button w3-large w3-wide" id="terminal_tab" onclick="document.getElementById('terminal').style.display ='block'"><i class="fa fa-terminal"></i>&nbsp;Console
            log</button>
        <button href="#" class="w3-bar-item w3-button w3-large w3-wide" id="setting_tab" onclick="document.getElementById('setting').style.display ='block'"><i class="fa fa-gear"></i>&nbsp;Setting</button>
        <button href="#" class="w3-bar-item w3-button w3-large w3-wide" id="logout_tab" onclick="document.getElementById('logout').style.display ='block'"><i class="fa fa-sign-out"></i>&nbsp;Logout</button>
    </div>
    <div class="w3-main" style="margin-left:200px">
        <div class="w3-teal">
            <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h2 class="w3-wide">Durian Fruit Maturity and Ripeness Evaluator</h2>
            </div>
        </div>
        <div>
            <div class="w3-panel w3-red w3-wide" id="non_member" style="display: block;">
                <h3>Opps!</h3>
                <p>You're not a member.</p>
                <p>You must Login first to enable important features:)</p>
            </div>

            <div class="chart-container" style="position: relative; height:70vh; width:100%" id="line_graph">
                <canvas id="predictionChart"></canvas>
            </div>

            <div class="w3-cell-row w3-padding" style="height: 80px;">
                <div class="w3-container w3-red w3-cell w3-cell-middle" style="width: 80%;">
                    <!-- <button id="scan" onclick="scan('*')" class="w3-button w3-block w3-hover-none">Scan</button> -->
                    <button id="scan" onclick="predict()" class="w3-button w3-block w3-hover-none">Scan</button>
                </div>
                <div class="w3-container w3-blue w3-cell w3-cell-middle" id="remove_dataset" style="width: 20%">
                    <button id="remove_dataset" onclick="removeDataset(predictionChart)" class="w3-button w3-block w3-hover-none">Remove
                        Dataset</button>
                </div>
            </div>

            <div style="display: none;">
                <button class="w3-green w3-padding" onclick="train()">Train</button>
                <button class="w3-yellow w3-padding" onclick="predict()">Predict</button>
            </div>
            <div id="evaluation" style="display: none;">
                <p class="w3-red">Status: </p>
                <h2 class="w3-text-green">Evaluation Result</h2>
                <ul class="">
                    <li>Type of Specimen:</li>
                    <li>Content A:</li>
                    <li>Content B:</li>
                    <li>Content C:</li>
                </ul>
            </div>

        </div>



        <!-- <button id="randomizeData">Randomize Data</button> -->

        <!-- W3 Modal for Login Form -->

        <div id="login" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('login').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>
                <div class="w3-panel w3-red" id="login_error" style="display: none;">
                    <h3>Opps!</h3>
                    <p>You're not a member.</p>
                </div>

                <form class="w3-container">
                    <div class="w3-section">
                        <label><b>Username</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="username" id="username" required>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" id="password" required>
                        <input class="w3-check w3-margin-top" type="checkbox" name="remember" id="remember"> Remember me
                        <button class="w3-button w3-block w3-green w3-section w3-padding" type="button" onclick="login()">Login</button>

                    </div>
                </form>

                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('login').style.display='none'" type="submit" class="w3-button w3-red">Cancel</button>
                    <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
                </div>

            </div>
        </div>

        <!-- End of Login Form -->

        <!-- W3 Modal for Log-out Form -->

        <div id="logout" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('logout').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>

                <form class="w3-container">
                    <div class="w3-section">
                        <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" onclick="logout()">Logout</button>
                    </div>
                </form>

                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('login').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
                    <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
                </div>

            </div>
        </div>

        <!-- End of log-out Form -->

        <!-- W3 Modal for Terminal Log -->

        <div id="terminal" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('terminal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>
                <div class="w3-container">
                    <h1 class="w3-text-blue">Console log</h1>

                    <label>Logs</label>
                    <textarea class="w3-input" rows="5" id="rxConsole"></textarea>

                </div>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('terminal').style.display='none'" type="button" class="w3-button w3-red">Close</button>
                    <span class="w3-right w3-padding w3-small"><a class="fa fa-download w3-padding-small w3-green" id="download_log" download="data_log.txt" onclick="downloadTxt()"></a>&nbsp;Save as txt?</span>
                </div>

            </div>
        </div>

        <!-- End of Terminal Log -->

        <!-- W3 Modal for Machine Learing Log -->

        <div id="trainning" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('trainning').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>
                <div class="w3-panel w3-red" id="trainning_error" style="display: none;">
                    <h3>Opps!</h3>
                    <p>Something wrong happened.</p>
                </div>
                <div class="w3-panel w3-green" id="trainning_done" style="display: none;">
                    <h3>WOW!</h3>
                    <p>Finnish, why don't you give a try?</p>
                </div>
                <div class="w3-container">
                    <h1 class="w3-text-blue">Make me more Smarter</h1>

                    <label class=""><b>Upload Trainning datasets</b></label>
                    <input class="w3-input w3-border" type="file" name="trainning_data" id="trainning_data" placeholder="spectral_data.json" accept=".json" required>

                    <label class=""><b>Learning Rate</b></label>
                    <input class="w3-input w3-border" type="number" name="learning_rate" id="learning_rate" placeholder="0.199" value="0.199">
                    <label class=""><b>Epochs</b></label>
                    <input class="w3-input w3-border" type="number" name="epochs" id="epochs" placeholder="5" value="5">
                    <label class=""><b>Iteration</b></label>
                    <input class="w3-input w3-border" type="number" name="epochs" id="iteration" placeholder="10" value="10">

                    <input class="w3-check" type="checkbox" name="shuffle" id="shuffle" checked="checked">
                    <label>Shuffle</label>

                    <p>
                        <button class="w3-btn w3-teal" id="train" onclick="train().then(() => { document.getElementById('trainning_status').innerHTML = 'Status : Trainning Complete!';});">Train</button>

                        <span class="w3-right w3-padding w3-small" id="trainning_score_status">Trainning Score :0%</span>
                        <span class="w3-right w3-padding w3-small" id="trainning_status">Status: N/A</span>
                    </p>

                </div>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('trainning').style.display='none'" type="button" class="w3-button w3-red">Close</button>
                    <span class="w3-right w3-padding w3-small"><a class="fa fa-download w3-padding-small w3-green" id="download_model_json" onclick="download_model_json().then(() => {Swal.fire('Saved!', 'success')})"></a>&nbsp;Download model as .jSON</span>
                    <span class="w3-right w3-padding w3-small"><a class="fa fa-refresh w3-padding-small w3-blue" onclick="load_model_json().then(()=> {Swal.fire({title: 'Loaded!', icon: 'success' })})"></a>&nbsp;Load Model</span>
                </div>

            </div>
        </div>

        <!-- End of Machine Learning -->

        <!-- W3 Modal for Report Generation -->

        <div id="report" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('report').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>
                <div class="w3-panel w3-red" id="report_error" style="display: none;">
                    <h3>Opps!</h3>
                    <p>Something wrong happened.</p>
                </div>
                <div class="w3-panel w3-green" id="report_done" style="display: none;">
                    <h3>HORRY!</h3>
                    <p>Wait for a while, i'm preparing your data.</p>
                </div>
                <div class="w3-container">

                    <h1 class="w3-text-blue">Report</h1>

                </div>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('report').style.display='none'" type="button" class="w3-button w3-red">Close</button>
                    <span class="w3-right w3-padding w3-small"><button class="fa fa-download w3-padding-small w3-green"></button>&nbsp;Download as PDF?</span>
                    <span class="w3-right w3-padding w3-small"><button class="fa fa-upload w3-padding-small w3-blue"></button>&nbsp;Upload to Cloud Pool?</span>
                </div>

            </div>
        </div>

        <!-- End of Report Generation -->


        <!-- W3 Modal for Data Labeling  -->

        <div id="labeling" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('labeling').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>
                <div class="w3-panel w3-red" id="report_error" style="display: none;">
                    <h3>Opps!</h3>
                    <p>Something wrong happened.</p>
                </div>
                <div class="w3-panel w3-green" id="report_done" style="display: none;">
                    <h3>HORRY!</h3>
                    <p>Wait for a while, i'm preparing your data.</p>
                </div>
                <div class="w3-container">
                    <h1 class="w3-text-blue">Data Labeling</h1>
                    <div class="chart-container" style="position: relative; height:40vh; width:100%" id="labeling_line_graph">
                        <canvas id="labeling_chart"></canvas>
                    </div>
                    <p>
                        <button class="w3-button w3-blue-gray" id="" onclick="popup_labeling_data()"><label>Scan</label></button>
                        <!-- <button class="w3-button w3-blue-gray" id="" onclick="scan('#')"><label>Scan</label></button> -->
                    </p>
                    <div class="w3-center">

                        <input class="w3-radio" type="radio" name="label" value="0">
                        <label class="w3-text-blue">Unknown</label>

                        <input class="w3-radio" type="radio" name="label" value="1" checked>
                        <label class="w3-text-green">Ripe</label>

                        <input class="w3-radio" type="radio" name="label" value="2">
                        <label class="w3-text-pink">Matured</label>

                        <input class="w3-radio" type="radio" name="label" value="3">
                        <label class="w3-text-blue">Prematured</label>

                        <button class="w3-btn w3-teal" id="train" onclick="findLabel()">Train</button>
                        <!-- <button type="w3-button w3-red" onclick="findLabel()">Submit</button> -->
                    </div>
                    <p>
                        <span class="w3-right w3-padding w3-small" id="trainning_status">Status: N/A</span>
                    </p>

                </div>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('labeling').style.display='none'" class="w3-button w3-red w3-margin w3-padding">Close</button>
                    <span class="w3-right w3-padding w3-small"><a class="fa fa-download w3-padding-small w3-green" id="download_json"></a>&nbsp;Download as .JSON?</span>
                    <!-- <span class="w3-right w3-padding w3-small"><button class="fa fa-upload w3-padding-small w3-blue"></button>&nbsp;Upload to Cloud Pool?</span> -->
                </div>

            </div>
        </div>

        <!-- End of Report Generation -->

        <!-- W3 Modal for Settings -->

        <div id="setting" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('setting').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>
                <div class="w3-panel w3-red" id="saving_error" style="display: none;">
                    <h3>Opps!</h3>
                    <p>Something wrong happened.</p>
                </div>
                <div class="w3-panel w3-green" id="saving_done" style="display: none;">
                    <h3>NICE!</h3>
                    <p>I feel something new.</p>
                </div>
                <div class="w3-container">
                    <div class="form-group">
                        <!-- <label for="rxConsole">Settings:</label>
                    <textarea class="form-control" rows="10" id="rxConsole"></textarea> -->
                        <div class="w3-container">
                            <h1 class="w3-text-blue">Settings</h1>
                            <div style="display: none;">

                                <!-- <p>Number of Samples</p> -->
                                <label class=""><b>Number of Samples</b></label>
                                <select class="w3-select" name="sampling" id="sampling" required>
                                    <option value="1" disabled selected>Choose your sample count per scan</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <p>Note: The Higher the sample the slower</p>

                            </div>
                            <div style="display: none;">

                                <label class=""><b>Gain</b></label>
                                <select class="w3-select" name="gain" id="gain" required>
                                    <option value="3" disabled selected>Select your desired gain</option>
                                    <option value="0">1</option>
                                    <option value="1">2</option>
                                    <option value="2">3</option>
                                    <option value="3">4</option>
                                </select>
                                <p>Note: The Higher the gain the higher the sensitiviy</p>

                            </div>
                            <div style="display: none;">

                                <label class=""><b>Measurement Mode</b></label>
                                <select class="w3-select" name="measurement_mode" id="measurement_mode">
                                    <option value="2" disabled selected>Choose your Measurement Mode</option>
                                    <option value="0">Option 1</option>`
                                    <option value="1">Option 2</option>
                                    <option value="2">Option 3</option>
                                </select>
                                <p>Note: The Higher the sample the slower</p>

                            </div>
                            <div style="display: none;">

                                <label class=""><b>Company</b></label>
                                <input class="w3-input w3-border" type="text" placeholder="Company name" id="company_name" required>


                            </div>
                            <div style="display: none;">

                                <label class=""><b>License Code</b></label>
                                <input class="w3-input w3-border" type="text" placeholder="0X-1E2I91" id="license_code" required>

                            </div>
                            <!-- <input class="w3-check w3-margin-top" type="checkbox" checked name="with_bulb" id="with_bulb">With Bulb -->
                            <input class="w3-check w3-margin-top" type="checkbox" checked name="show_graph" id="show_graph">Show Line Graph
                            <input class="w3-check w3-margin-top" type="checkbox" checked name="show_misc" id="show_misc">Show Misc.
                            <p class="w3-padding">
                                <button class="w3-btn w3-teal" onclick="save_setting()" id="save_setting_btn">Save</button>
                                <button id="reconnect" onclick="connect()" type="button" class="w3-button w3-red" id="connect_btn">Re/Connect</button>
                                <span class="w3-right w3-padding w3-small" id="connection_status">Status: Not
                                    Connected</span>
                            </p>
                        </div>

                    </div>

                    <div>
                    </div>
                </div>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('setting').style.display='none'" type="button" class="w3-button w3-red">Close</button>
                    <!-- <span class="w3-right w3-padding w3-hide-small"><button class="fa fa-download w3-padding-small w3-green"></button>&nbsp;Download as PDF?</span> -->
                    <span class="w3-right w3-padding w3-small"><button class="fa fa-check-circle-o w3-padding-small w3-blue" id="apply_setting_btn" onclick="load_setting()"></button>&nbsp;Apply Changes?</span>
                </div>

            </div>
        </div>

        <!-- End of Settings -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        var json = {};
        let labelList = [
            'Unknown',
            'Ripe',
            'Matured',
            'Prematured'
        ];
        
        let dataStr1 = "data:text/json;charset=utf-8," + encodeURIComponent(((localStorage.getItem('labeled'))));
        let dlAnchorElem = document.getElementById('download_json');
        dlAnchorElem.setAttribute("href", dataStr1);
        dlAnchorElem.setAttribute("download", "spectral_data.json");
        
        const jsonFile = document.getElementById('trainning_data').addEventListener("change", handleFile, false);

        function popup_labeling_data() {
            removeDataset(labelingChart);
            Swal.fire({
                title: 'Enter Spectral Data?',
                input: "text",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit'
            }).then((result) => {
                if (result.value) {
                    try {
                        json = JSON.parse(result.value);
                        let data = [json.ch1, json.ch2, json.ch3, json.ch4, json.ch5, json.ch6];
                        addDataset(labelingChart, "Scanned", data);
                        input = tf.tensor2d([
                            [json.ch1, json.ch2, json.ch3, json.ch4, json.ch5, json.ch6]
                        ]);
                    } catch (e) {
                        console.log(e);
                        Swal.fire({
                            title: 'Error!',
                            html: 'Invalid Data.',
                            icon: 'error'
                        })
                        return;
                    }
                    Swal.fire({
                        title: 'Saved!', 
                        html: 'Data is ready to label.',
                        icon: 'success'
                    })
                }
            })
        }

        function SaveDataToLocalStorage(location, data) {
            var a = [];
            a = JSON.parse(localStorage.getItem(location)) || []; // Parse the serialized data back into an aray of objects
            a.push(data); // Push the new data (whether it be an object or anything else) onto the array
            localStorage.setItem('labeled', JSON.stringify(a)); // Re-serialize the array back into a string and store it in localStorage
            log('Saving labeled data to the local storage of the browser; Loacation :' +location );
        }

        async function download_model_json() {
            const model_json = await model.save('downloads://NIR_model');
            log('Downloading trained model as .json file');
            const model_json_localStorage = await model.save('localstorage://NIR_model');
            log('Downloading trained model to local storage of the browser');
        }
        async function load_model_json() {
            const load_model_json = await tf.loadLayersModel('localstorage://NIR_model');
            log('Loading trained model from local storage of the browser');
        }

        function handleFile() {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    let jsonData = JSON.parse(e.target.result);
                    let temp_xs = [];
                    let temp_ys = [];
                    jsonData.forEach(function(data, index) {
                        temp_xs.push([data.ch1, data.ch2, data.ch3, data.ch4, data.ch5, data.ch6]);
                        temp_ys.push(data.label_args);
                    })
                    console.log(temp_ys);
                    xs = tf.tensor2d(temp_xs);
                    let indices = tf.tensor1d(temp_ys, 'int32');
                    ys = tf.oneHot(indices, 3);
                    indices.print();
                    xs.print();
                    ys.print();
                } catch (e) {
                    console.log(e);
                    Swal.fire({
                        title: 'Error Loading File!',
                        html: 'invalid json file',
                        icon: 'error'
                    })
                    return false;
                }
            };
            reader.readAsText(file);
            log('Loading Dataset with filename: '+file.name, +' size : '+file.size);
        }
        
    </script>
    <script src="./assets/js/controller.js"></script>

</html>