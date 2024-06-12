<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kalkulator BMI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .gender-option {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #ced4da;
      padding: 7px;
      border-radius: 5px;
      cursor: pointer;
      transition: border-color 0.3s;
    }
    .gender-option:hover {
      border-color: #0d6efd;
    }
    .gender-option .form-check-input {
      display: none;
    }
    .gender-option .form-check-label {
      margin-bottom: 0;
      margin-left: 8px;
      display: flex;
      align-items: center;
      text-align: center;
    }
    .gender-option .form-check-label img {
      margin-right: 5px;
    }
    .gender-option.selected {
      border-color: #0d6efd;
    }
    .gender-option.selected .form-check-label {
      font-weight: bold;
    }
    .ruler {
        display: flex;
        height: 20px;
        overflow: hidden;
        width: 100%;
    }
    .bar {
        flex-grow: 1;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="fw-bold text-center mb-4">Kalkulator Body Mass Index (BMI)</h2>
        <form>
          <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir Anda</label>
            <input type="date" class="form-control" id="tglLhr" name="tglLhr">
          </div>
          <div class="mb-3">
            <label class="form-label d-block">Apa jenis kelamin Anda?</label>
            <div class="row">
              <div class="col">
                <div class="gender-option" onclick="selectGender('laki')">
                  <input class="form-check-input" type="radio" name="jk" id="laki" value="male">
                  <label class="form-check-label" for="laki">
                    <img src="https://hhg-common.hellosehat.com/common/health-tools/female-icon.svg" alt="male" width="24">
                    <span>Laki-laki</span>
                  </label>
                </div>
              </div>
              <div class="col">
                <div class="gender-option" onclick="selectGender('perempuan')">
                  <input class="form-check-input" type="radio" name="jk" id="perempuan" value="female">
                  <label class="form-check-label" for="perempuan">
                    <img src="https://hhg-common.hellosehat.com/common/health-tools/male-icon.svg" alt="female" width="24">
                    <span>Perempuan</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="tinggi" class="form-label">Berapa tinggi Anda? (cm)</label>
            <input type="number" class="form-control" id="t" name="t" min="0" step="1">
          </div>
          <div class="mb-3">
            <label for="berat_badan" class="form-label">Berapa berat badan Anda? (kg)</label>
            <input type="number" class="form-control" id="bb" name="bb" min="0" step="1">
          </div>
          <button type="button" class="btn btn-primary w-100" onclick="hitung()">Hitung</button>
        </form>
        <div id="result"></div>
      </div>
    </div>
  </div>

  <script>
    function selectGender(gender) {
        document.querySelectorAll('.gender-option').forEach(option => {
            option.classList.remove('selected');
        });

        let container = document.getElementById(gender);
        if(container) {
            container.parentNode.classList.add('selected');

            let radioElement = document.getElementById(gender);
            if (radioElement) {
                radioElement.checked = true;
            }
        }
    }

    function hitung(){
        var tglLhr = document.getElementById('tglLhr').value;
        var radios = document.getElementsByName('jk');
        var selectedValue;
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                selectedValue = radios[i].value;
                break;
            }
        }
        var tinggi = document.getElementById('t').value;
        var bb = document.getElementById('bb').value;

        var formData = new FormData();
        formData.append('tglLhr', tglLhr);
        formData.append('jk', selectedValue);
        formData.append('t', tinggi);
        formData.append('bb', bb);

        fetch('kalkulate.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            var underweightClass, healthyClass, overweightClass, obesity1Class, obesity2Class,bold1, bold2, bold3, bold4, bold5, w, c;
            if(data.status == true){
                var result = ``;
                result += `<div class='mt-4 mb-4'>
                <div class='mt-4'>
                    <h1 class='text-center'>BMI Anda adalah <span style='color: #2d87f3;'>${data.bmi}</span></h1>
                </div>
                <div class='mt-4'>
                <div class='row'>`;
                
                if (data.bmi > 0 && data.bmi <= 18.5) {
                    underweightClass = 'active';
                    healthyClass = overweightClass = obesity1Class = obesity2Class = 'inactive';
                    bold1 = style='color: #2d87f3;font-weight: bold';
                    w = '15%';
                    c = '#3498db';
                } else if (data.bmi > 18.5 && data.bmi <= 23) {
                    healthyClass = 'active';
                    underweightClass = overweightClass = obesity1Class = obesity2Class = 'inactive';
                    bold2 = style='color: #2d87f3;font-weight: bold';
                    w = '45%';
                    c = '#2ecc71';
                } else if (data.bmi > 23 && data.bmi <= 25) {
                    overweightClass = 'active';
                    underweightClass = healthyClass = obesity1Class = obesity2Class = 'inactive';
                    bold3 = style='color: #2d87f3;font-weight: bold';
                    w = '60%';
                    c = '#f1c40f';
                } else if (data.bmi > 25 && data.bmi <= 30) {
                    obesity1Class = 'active';
                    underweightClass = healthyClass = overweightClass = obesity2Class = 'inactive';
                    bold4 = style='color: #2d87f3;font-weight: bold';
                    w = '73%';
                    c = '#e67e22';
                } else {
                    obesity2Class = 'active';
                    underweightClass = healthyClass = overweightClass = obesity1Class = 'inactive';
                    bold5 = style='color: #2d87f3;font-weight: bold';
                    w = '88%';
                    c = '#e74c3c';
                }

                result += `
                <div class='col text-center'>
                    <img src='https://hellosehat.com/images/bmi-underweight-${selectedValue}-${underweightClass}.svg' alt='Underweight' class='img-fluid' style='height: 200px;'>
                    <div class='text-container' ${bold1}>
                        <p>Kekurangan Bobot</p>
                        <p>< 18.4</p>
                    </div>
                </div>
                <div class='col text-center'>
                    <img src='https://hellosehat.com/images/bmi-obese_level_2-${selectedValue}-${obesity2Class}.svg' alt='Healthy' class='img-fluid' style='height: 200px;'>
                    <div class='text-container' ${bold2}>
                        <p>Obesitas 2</p>
                        <p>30 - 30+</p>
                    </div>
                </div>
                <div class='col text-center'>
                    <img src='https://hellosehat.com/images/bmi-overweight-${selectedValue}-${overweightClass}.svg' alt='Overweight' class='img-fluid' style='height: 200px;'>
                    <div class='text-container' ${bold3}>
                        <p>Kelebihan Bobot</p>
                        <p>23 - 25</p>
                    </div>
                </div>
                <div class='col text-center'>
                    <img src='https://hellosehat.com/images/bmi-obese_level_1-${selectedValue}-${obesity1Class}.svg' alt='Obesitas 1' class='img-fluid' style='height: 200px;'>
                    <div class='text-container' ${bold4}>
                        <p>Obesitas 1</p>
                        <p>25 - 30</p>
                    </div>
                </div>
                <div class='col text-center'>
                    <img src='https://hellosehat.com/images/bmi-healthy-${selectedValue}-${healthyClass}.svg' alt='Obesitas 2' class='img-fluid' style='height: 200px;'>
                    <div class='text-container' ${bold5}>
                        <p>Sehat</p>
                        <p>18.5 - 23</p>
                    </div>
                </div>`;
                result += `</div></div>
                <h6 style="margin-left: ${w};background-color: ${c}; width: 8%; text-align: center; border-radius: 10px">${data.bmi}</h6>
                <div class="ruler">
                    <div class="bar" style="background-color: #3498db; width: 35%">
                        <h6 class="bar-text">0</h6>
                    </div>
                    <div class="bar" style="background-color: #2ecc71; width: 25%">
                        <h6 class="bar-text">18.5</h6>
                    </div>
                    <div class="bar" style="background-color: #f1c40f; width: 10%">
                        <h6 class="bar-text">23</h6>
                    </div>
                    <div class="bar" style="background-color: #e67e22; width: 15%">
                        <h6 class="bar-text">25</h6>
                    </div>
                    <div class="bar" style="background-color: #e74c3c; width: 15%">
                        <h6 class="bar-text">30+</h6>
                    </div>
                </div>
                </div>`;
                document.getElementById('result').innerHTML = result;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

  </script>
</body>
</html>