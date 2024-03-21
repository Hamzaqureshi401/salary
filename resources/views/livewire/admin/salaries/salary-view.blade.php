<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Salary Slip</title>
  <style>
    .salary-slip {
      margin: 20px;
      border: 1px solid #ccc;
      padding: 20px;
    }
    .bg-silver {
      background-color: #d0d0d0;
    }
    .pd {
      padding: 0px;
    }
    .pd-l-r {
      padding-left: 0px;
      padding-right: 0px;
    }
    .pd strong {
      font-size: 18px;
      font-weight: bold;
    }
    .pd-t-b {
      padding-top: 22px;
      padding-bottom: 22px;
    }
    .border-t-b {
      border-top: 2px solid;
      border-bottom: 2px solid;
    }
    .border-t {
      border-top: 2px solid;
    }

    /* Styles for printing */
    @media print {
      body {
          -webkit-print-color-adjust: exact;
          color-adjust: exact; /*firefox & IE */
          visibility: hidden;
      }
        
      .salary-slip {
          visibility: visible;
          position: absolute;
          left: 0;
          top: 0;
      }
      .bg-silver,
      .pd strong,
      .border-t-b,
      .border-t {
        color: black !important; /* Ensure colors are visible when printing */
      }
      .table td {
            font-size: 10px; /* Adjust the font size as needed */
        }

      .sm-f {
        padding-top: 3px;
          padding-bottom: 3px;
      }
        .mb-4 {
          margin-bottom: 0.5rem !important;
      }
    }
  </style>
</head>
<body>
  <div class="salary-slip">
    <div class="row pd-t-b bg-silver">
      <div class="col-12 text-center">
        <h1>Lønseddel</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-3">
        <div class="row">
          <div class="col-12"><strong>Name: {{ $record->employee->name }}</strong></div>
          <div class="col-12">
            <p>{{ $record->employee->address }}</p>
          </div>
          <div class="col-12"> CPR. nr.: {{ $record->employee->cpr_no }}</div>
          <div class="col-12"> Trækprocent: {{ $record->employee->draw_percentage }}</div>
          <div class="col-12"> Månedsfradrag: {{ $record->employee->monthly_deduction }}</div>
        </div>
      </div>
      <div class="col-6"></div>
      <div class="col-3">
        <div class="row">
          <div class="col-12"><strong>Firma: {{getStoreName()}}</strong></div>
          <div class="col-12"><strong>CVR. Nr.: DK 3909 3308</strong></div>
        </div>
      </div>
    </div>
    <div class="row bg-silver pd-t-b sm-f">
      <div class="col-4">
        <div class="row">
          <div class="col-12"><strong>LØNPERIODE</strong></div>
          <div class="col-12">{{ date('M-y', strtotime($record->salary_date)) }}</div>
        </div>
      </div>
      <div class="col-4">
        <div class="row text-center">
          <div class="col-12"><strong>UDBETALINGSDATO</strong></div>
          <div class="col-12">{{ date('d-m-Y', strtotime($record->salary_date)) }}</div>
        </div>
      </div>
      <div class="col-4">
        <div class="row text-end">
          <div class="col-12"><strong>TIL UDBETALING</strong></div>
          <div class="col-12"><span style="color: #00b0f0; font-size: 29px;">{{ number_format($record->net_salary, 2, ',', '.') }} kr.</span></div>
        </div>
      </div>
    </div>
    <div class="row pd">
      <div class="col-3">Gage</div>
      <div class="col-3 text-center">{{ $record->working_hours}} Timer af</div>
      <div class="col-3 text-center">{{ number_format($record->hourly_rate, 2, ',', '.') }} kr.</div>
      <div class="col-3 text-end">{{ number_format($record->hourly_gross_salary, 2, ',', '.') }} kr.</div>
      <div class="col-6">ATP</div>
      <div class="col-6 text-end">{{ number_format($record->atp_tax, 2, ',', '.') }} kr.</div>
    </div>
    <div class="row pd-l-r border-t-b">
      <div class="col-6"><strong>AM Indkomst</strong></div>
      <div class="col-6 text-end"><strong>{{ number_format($record->am_income, 2, ',', '.') }}</strong></div>
    </div>
    <div class="row pd-l-r mb-4">
      <div class="col-3">AM-bidrag:</div>
      <div class="col-3 text-center">{{ $record->am_contributions }} % af</div>
      <div class="col-3 text-center">{{ number_format($record->am_income, 2, ',', '.') }} kr.</div>
      <div class="col-3 text-end">{{ number_format($record->am_tax, 2, ',', '.') }} kr.</div>
    </div>
    <div class="row pd-l-r border-t-b mb-4">
      <div class="col-6"><strong>A-indkomst</strong></div>
      <div class="col-6 text-end"><strong>{{ number_format($record->a_income, 2, ',', '.') }} kr.</strong></div>
    </div>
    <div class="row pd-l-r mb-4">
      <div class="col-4">A-skattepligtig indkomst</div>
      <div class="col-4 text-end">{{ number_format($record->a_income, 2, ',', '.') }} kr.</div>
      <div class="col-4"></div>
      <div class="col-4">Personligt fradrag:</div>
      <div class="col-4 text-end">{{ number_format($record->personal_deduction, 2, ',', '.') }} kr.</div>
      <div class="col-4"></div>
      <div class="col-8 border-t"></div>
      <div class="col-4"></div>
      <div class="col-4"><strong>Skattegrundlag:</strong></div>
      <div class="col-4 text-end">{{ number_format($record->tax_base, 2, ',', '.') }} kr.</div>
      <div class="col-8 border-t"></div>
      <div class="col-4"></div>
    </div>
    <div class="row pd-l-r mb-4">
      <div class="col-3">A-Skat:</div>
      <div class="col-3 text-center">{{ $record->draw_percentage }} % af</div>
      <div class="col-3 text-center">{{ number_format($record->tax_base, 2, ',', '.') }} kr.</div>
      <div class="col-3 text-end">{{ number_format($record->tax_amount, 2, ',', '.') }} kr.</div>
    </div>
    <div class="row pd-l-r mb-4">
      <div class="col-3">Kørselgodtgørelse:</div>
      <div class="col-3 text-center">{{ $record->traveling_hours }} % kmaf</div>
      <div class="col-3 text-center">{{ number_format($record->da_rate, 2, ',', '.') }} kr.</div>
      <div class="col-3 text-end">{{ number_format($record->driving_allowance, 2, ',', '.') }} kr.</div>
    </div>
    <div class="row pd-l-r mb-4 bg-silver">
      <div class="col-6"><strong>Nettoløn til udbetaling:</strong></div>
      <div class="col-6 text-end"><strong>{{ number_format($record->net_salary, 2, ',', '.') }} kr.</strong></div>
    </div>
    <div class="row bg-silver pd">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="col-4">Saldi</th>
                <th class="col-4 text-center">Perioden</th>
                <th class="col-4 text-end">År til dato:</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="col-4">AM Indkomst</td>
                <td class="col-4 text-center">{{ number_format($record->am_income, 2, ',', '.') }}</td>
                <td class="col-4 text-end">{{  number_format($salarySummary->total_am_income, 2, ',', '.') }}</td>
              </tr>
              <tr>
                <td class="col-4">A-indkomst</td>
                <td class="col-4 text-center">{{ number_format($record->a_income, 2, ',', '.') }}</td>
                <td class="col-4 text-end">{{  number_format($salarySummary->total_a_income, 2, ',', '.') }}</td>
              </tr>
              <tr>
                <td class="col-4">A-Skat</td>
                <td class="col-4 text-center">{{ number_format($record->tax_amount, 2, ',', '.') }}</td>
                <td class="col-4 text-end">{{  number_format($salarySummary->total_a_tax, 2, ',', '.') }}</td>
              </tr>
              <tr>
                <td class="col-4">AM-bidrag</td>
                <td class="col-4 text-center">{{ number_format($record->am_tax, 2, ',', '.') }}</td>
                <td class="col-4 text-end">{{  number_format($salarySummary->total_am_contributions, 2, ',', '.') }}</td>
              </tr>
              <tr>
                  <tr>
                <td class="col-4">ATP</td>
                <td class="col-4 text-center">{{ number_format($record->atp_tax, 2, ',', '.') }}</td>
                <td class="col-4 text-end">{{  number_format($salarySummary->total_atp_taxl, 2, ',', '.') }}</td>
              </tr>
              <tr>
                <td class="col-4">Kørselgodtgørelse</td>
                <td class="col-4 text-center">{{ number_format($record->driving_allowance, 2, ',', '.') }}</td>
                <td class="col-4 text-end">{{  number_format($salarySummary->total_driving_allowance, 2, ',', '.') }}</td>
              </tr>
                <td class="col-4">Arbejdstimer</td>
                <td align=right; class="col-4 text-center">{{ $record->working_hours}}</td>
                <td class="col-4 text-end">{{  number_format($salarySummary->total_working_hours, 2, ',', '.') }}</td>
              </tr>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

 <!--  -->
</body>
</html>
