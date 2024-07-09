<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <style type="text/css">
    @media (min-width: 576px) {
      .dropdown:hover>.dropdown-menu {
        display: block;

      }
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
  <header>
    <!------------------------------------------ navigation bar ------------------------------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">RSD LEGAL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="home.html" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Home
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="home.html">Dashboard</a></li>
                <li><a class="dropdown-item" href="Recent Activities.html">Recent Activities</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="calendar.html" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Calendar
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Day</a></li>
                <li><a class="dropdown-item" href="#">Week</a></li>
                <li><a class="dropdown-item" href="#">Month</a></li>
                <li><a class="dropdown-item" href="#">Agenda</a></li>
                <li><a class="dropdown-item" href="#">Location</a></li>
                <li><a class="dropdown-item" href="#">Calendar Sync</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tasks.html">Task</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="contacts.html" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Contacts
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="contacts.html">People</a></li>
                <li><a class="dropdown-item" href="companies.html">Companies</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="cases.html" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Cases
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">My Open Cases</a></li>
                <li><a class="dropdown-item" href="#">My Closed Cases</a></li>
                <li><a class="dropdown-item" href="#">Firm Open Cases</a></li>
                <li><a class="dropdown-item" href="#">Firm Closed Cases</a></li>
                <li><a class="dropdown-item" href="#">Practice Areas</a></li>
                <li><a class="dropdown-item" href="#">Case insights</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="documents.html" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Documents
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Case Documents</a></li>
                <li><a class="dropdown-item" href="#">Inread Case Documents</a></li>
                <li><a class="dropdown-item" href="#">Firm Documents</a></li>
                <li><a class="dropdown-item" href="#">eSignature Documents</a></li>
                <li><a class="dropdown-item" href="#">Intake Forms</a></li>
                <li><a class="dropdown-item" href="#">Word Templates</a></li>
                <li><a class="dropdown-item" href="#">eSignature Templates</a></li>
                <li><a class="dropdown-item" href="#">Advanced Templates</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="billing.html" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Billing
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="home.html">Dashboard</a></li>
                <li><a class="dropdown-item" href="#">Time Entries</a></li>
                <li><a class="dropdown-item" href="#">Expenese</a></li>
                <li><a class="dropdown-item" href="#">Requested funds</a></li>
                <li><a class="dropdown-item" href="#">invoices</a></li>
                <li><a class="dropdown-item" href="#">Statements</a></li>
                <li><a class="dropdown-item" href="#">Reconciliation</a></li>
                <li><a class="dropdown-item" href="#">Payment Plans</a></li>
                <li><a class="dropdown-item" href="#">Saved Activities</a></li>
                <li><a class="dropdown-item" href="#">Account Activity</a></li>
                <li><a class="dropdown-item" href="#">Trust Accounting</a></li>
                <li><a class="dropdown-item" href="#">Financial Insights</a></li>
                <li><a class="dropdown-item" href="#">Timesheet Calendar</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Payments
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Transactions</a></li>
                <li><a class="dropdown-item" href="Recent Activities.html">Account Activity</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="communications" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Communications
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Emails</a></li>
                <li><a class="dropdown-item" href="#">Messages</a></li>
                <li><a class="dropdown-item" href="#">Call Log</a></li>
                <li><a class="dropdown-item" href="#">Text Messages</a></li>
                <li><a class="dropdown-item" href="#">Comments</a></li>

              </ul>
            </li>

            <!--------------------------------------------- search group button------------------------------------ -->
            <div class="col align-self-end">
              <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <div class="btn-group dropdown-item">
                <button type="button" class="btn btn-secondary">
                  Search
                </button>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="visually-hidden"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href=""></a></li>
                  <li>Cases</li>
                  <li>All</li>
                  <li>Contacts</li>
                  <li>Documents</li>
                  <li>Task</li>
                </ul>

              </div>

            </form></div>
            
        </div>
      </div>
    </nav>




    <!-- -------------------------------------------------------too bar---------------------------------------------- -->

    <div class="my-1"></div>

    <div id="subbar-navigation" class="clearfix d-print-none d-none d-lg-block">
      <nav class="navbar navbar-expand-lg navbar-light bg-light ps-4 pe-1 py-0 border-bottom test-subbar-nav">
        <ul class="navbar-nav me-auto">
          
<li class="nav-item">
  <a class="pendo-subnav-dashboard nav-link " href="#">Dashboard</a>
</li>

<li class="nav-item">
  <a class="pendo-subnav-recent-activity nav-link active" href="Recent Activities.html">Recent Activity</a>
</li>

        </ul>
      </nav>
    </div>

    <!---------------------------------------------------------- end of nav bar--------------------------------------------------- -->




  </header>

  <main>



    <!-- ---------------------------------------------add items card------------------------------------------------------------>
    <div class="card mt-2 mb-3 ms-3 me-1">
      <div class="card-header">
        <h4 class="h5 fw-bold card-title">Add Item</h4>
      </div>

      <div class="card-body p-1 text-nowrap">
        <div class="dashboard-add-item-section d-flex">
          <div class="flex-fill p-3 text-center border-end">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                <path
                  d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                <path
                  d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
              </svg>
              <span class="d-none d-lg-inline">Event</span>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                <path
                  d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                <path
                  d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
              </svg>
              <span class="d-none d-lg-inline">Document</span>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
            <div>
              <img alt="" class="me-1" src="https://assets.mycase.com/packs/svg/icons/task__inactive-7cd93c8b30.svg"
                width="24" height="24">
              <span class="d-none d-lg-inline"> Task</span>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
            <div>
              <img alt="" class="me-1" src="https://assets.mycase.com/packs/svg/icons/lead_inactive-9d8382b69d.svg"
                width="24" height="24">
              <span class="d-none d-lg-inline"> Lead</span>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
            <div>
              <img alt="" class="me-1" src="https://assets.mycase.com/packs/svg/icons/contact__inactive-553b991a0a.svg"
                width="24" height="24">
              <span class="d-none d-lg-inline"> Contact</span>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
            <div>
              <img alt="" class="me-1"
                src="https://assets.mycase.com/packs/svg/icons/court_case__inactive-7f626d1447.svg" width="24"
                height="24">
              <span class="d-none d-lg-inline"> Case</span>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
            <div>
              <img alt="" class="me-1" src="https://assets.mycase.com/packs/svg/icons/message__inactive-5d88c1047e.svg"
                width="24" height="24">
              <span class="d-none d-lg-inline">Message</span>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
            <div>
              <img alt="" class="me-1"
                src="https://assets.mycase.com/packs/svg/icons/time_entry__inactive-6ea491d3e1.svg" width="24"
                height="24">
              <span class="d-none d-lg-inline"> Time Entry</span>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
            <div>
              <img alt="" class="me-1" src="https://assets.mycase.com/packs/svg/icons/expense__inactive-4a8b673917.svg"
                width="24" height="24">
              <span class="d-none d-lg-inline"> Expense</span>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
            <div>
              <img alt="" class="me-1"
                src="https://assets.mycase.com/packs/svg/icons/invoice_add__inactive-13d544b943.svg" width="24"
                height="24">
              <span class="d-none d-lg-inline"> Invoice</span>
            </div>
          </div>

          <div class="flex-fill p-3 text-center">
            <div>
              <img alt="" class="me-1" src="https://assets.mycase.com/packs/svg/icons/note__inactive-d960397222.svg"
                width="24" height="24">
              <span class="d-none d-lg-inline"> Note</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ---------------------------------------------add items card ------------------------------------------------------------>




    <div id="lawyer-dashboard-container"
      data-permissions="{&quot;appointments_permission&quot;:true,&quot;financial_overview_permission&quot;:true,&quot;leads_over_time_permission&quot;:true,&quot;text_messaging_enabled&quot;:null,&quot;mailbox_enabled&quot;:false,&quot;can_view_messages&quot;:true,&quot;billing_permission&quot;:true,&quot;time_entries_permission&quot;:true,&quot;can_view_firm_reports&quot;:false,&quot;can_view_integrations&quot;:true,&quot;show_integrated_lawpay_payments_ad&quot;:true}"
      data-subscription-confirmation="false">
      <div class="ms-1 row ">
        <div class="col-8">
          <div class="py-2 mx-0 row ">
            <div class="m-0 p-0 col">
              <div class="card">
                <div class="card-header">
                  <div class="h5 fw-bold card-title"><a href="/bills/dashboard">My Timesheet</a></div>
                </div>
                <div class="mb-3 card-body">
                  <h5>Timesheet Calendar</h5>
                  <div class="timesheet-calendar-container">
                    <div class="week-view mb-4 ">
                      <div class="d-flex justify-content-end">
                        <div role="group" class="view-btn-group mb-2 me-auto btn-group">
                          <button type="button" class="btn btn-secondary btn-sm active">Billable</button>
                          <button type="button" class="btn btn-secondary btn-sm">Non-Billable</button>
                          <button type="button" class="btn btn-secondary btn-sm">All</button>
                        </div>
                        <div class="invisible">
                          <div class="standard loading-box">
                            <i class="fas fa-sync fa-spin fa-fw"></i><span class="loading-box-text ms-2"></span>
                          </div>
                        </div>
                        <div role="group" class="pe-2 mb-2 btn-group">
                          <button type="button" class="btn btn-secondary btn-sm">Today</button>
                        </div>
                        <div role="group" class="mb-2 btn-group">
                          <button type="button" class="btn btn-secondary btn-sm active">By Week</button>
                          <button type="button" class="btn btn-secondary btn-sm">By Month</button>
                        </div>
                      </div>
                      <div class="totals-calendar">
                        <div class="d-flex calendar-header">
                          <div role="group" class="btn-group">
                            <button type="button" data-testid="prev-large-increment" class="pb-2 btn btn-link"><i
                                class="fas fa-angle-double-left undefined"></i></button>
                            <button type="button" data-testid="prev-small-increment" class="pb-2 btn btn-link"><i
                                class="fas fa-angle-left undefined"></i></button>
                          </div>
                          <h4 class="m-auto">Nov 5 - Nov 11, 2023</h4>
                          <div role="group" class="btn-group">
                            <button type="button" data-testid="next-small-increment" class="pb-2 btn btn-link"><i
                                class="fas fa-angle-right undefined"></i></button>
                            <button type="button" data-testid="next-large-increment" class="pb-2 btn btn-link"><i
                                class="fas fa-angle-double-right undefined"></i></button>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-sm table-bordered">
                            <thead>
                              <tr>
                                <th class="bg-light text-center fw-light" style="width: 12.5%;">Sun</th>
                                <th class="bg-light text-center fw-light" style="width: 12.5%;">Mon</th>
                                <th class="bg-light text-center fw-light" style="width: 12.5%;">Tue</th>
                                <th class="bg-light text-center fw-light" style="width: 12.5%;">Wed</th>
                                <th class="bg-light text-center fw-light" style="width: 12.5%;">Thu</th>
                                <th class="bg-light text-center fw-light" style="width: 12.5%;">Fri</th>
                                <th class="bg-light text-center fw-light" style="width: 12.5%;">Sat</th>
                                <th class="bg-light text-center fw-light" style="width: 12.5%;">Total</th>
                              </tr>
                            </thead>
                            <tbody class="w-100">
                              <tr>
                                <td class="test-11-05-2023   " data-testid="11-05-2023">
                                  <div class="d-flex flex-column h-100 justify-content-between"><span
                                      class="align-self-start text-muted fw-light">5</span>
                                    <span class="test-day-total invisible ms-auto fw-bold text-light"
                                      data-testid="11-05-2023-total" style="font-size: 15px;">0.0</span>
                                  </div>
                                </td>
                                <td class="test-11-06-2023   " data-testid="11-06-2023">
                                  <div class="d-flex flex-column h-100 justify-content-between">
                                    <span class="align-self-start text-muted fw-light">6</span>
                                    <span class="test-day-total invisible ms-auto fw-bold text-light"
                                      data-testid="11-06-2023-total" style="font-size: 15px;">0.0</span>
                                  </div>
                                </td>
                                <td class="test-11-07-2023   " data-testid="11-07-2023">
                                  <div class="d-flex flex-column h-100 justify-content-between">
                                    <span class="align-self-start text-muted fw-light">7</span>
                                    <span class="test-day-total invisible ms-auto fw-bold text-light"
                                      data-testid="11-07-2023-total" style="font-size: 15px;">0.0</span>
                                  </div>
                                </td>
                                <td class="test-11-08-2023   " data-testid="11-08-2023">
                                  <div class="d-flex flex-column h-100 justify-content-between">
                                    <span class="align-self-start text-muted fw-light">8</span>
                                    <span class="test-day-total invisible ms-auto fw-bold text-light"
                                      data-testid="11-08-2023-total" style="font-size: 15px;">0.0</span>
                                  </div>
                                </td>
                                <td class="test-11-09-2023   " data-testid="11-09-2023">
                                  <div class="d-flex flex-column h-100 justify-content-between">
                                    <span class="align-self-start text-muted fw-light">9</span>
                                    <span class="test-day-total invisible ms-auto fw-bold text-light"
                                      data-testid="11-09-2023-total" style="font-size: 15px;">0.0</span>
                                  </div>
                                </td>
                                <td class="test-11-10-2023   " data-testid="11-10-2023">
                                  <div class="d-flex flex-column h-100 justify-content-between"><span
                                      class="align-self-start text-muted fw-light">10</span><span
                                      class="test-day-total invisible ms-auto fw-bold text-light"
                                      data-testid="11-10-2023-total" style="font-size: 15px;">0.0</span></div>
                                </td>
                                <td class="test-11-11-2023  today " data-testid="11-11-2023"
                                  style="background-color: rgb(231, 241, 252); border-width: 4px;">
                                  <div class="d-flex flex-column h-100 justify-content-between"><span
                                      class="align-self-start text-muted fw-light">11</span><span
                                      class="test-day-total invisible ms-auto fw-bold text-light"
                                      data-testid="11-11-2023-total" style="font-size: 15px;">0.0</span></div>
                                </td>
                                <td class="align-bottom text-end"><span class="h4 align-self-end"><strong
                                      class="test-week-0-total" data-testid="week-0-total"><a href="#"><span
                                          class=" ms-auto fw-bold text-light" data-testid=""
                                          style="font-size: 18px;">0.0</span></a></strong></span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="d-flex flex-row w-100">
                        <div>
                          <div class="me-auto">Billable Total: <strong class="test-billable-weekly">$0.00</strong></div>
                          <div class="text-muted">* Billable includes flat fee time entries</div>
                        </div>
                        <div class="ms-auto text-end">
                          <div>
                            <div class="d-flex"><span class="user-billing-target me-1">Billing
                                Target:</span><strong>None</strong></div><button type="button" id="link-target-44846905"
                              class="p-0 btn btn-link">Add goal</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <h5>Time Entries</h5>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>Billable</th>
                        <th>Non-billable</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>Today</th>
                        <td class="test-today-billable">0.0</td>
                        <td class="test-today-nonbillable">0.0</td>
                        <td class="test-today-total">$0.00</td>
                      </tr>
                      <tr>
                        <th>This week</th>
                        <td class="test-week-billable">0.0</td>
                        <td class="test-week-nonbillable">0.0</td>
                        <td class="test-week-total">$0.00</td>
                      </tr>
                      <tr>
                        <th>This month</th>
                        <td class="test-month-billable">0.0</td>
                        <td class="test-month-nonbillable">0.0</td>
                        <td class="test-month-total">$0.00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="py-2 mx-0 row ">
            <div class="m-0 p-0 col">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="h5 fw-bold card-title"><a href="/insights/financials">Financial Overview</a></div><span
                      id="financial-overview-info" data-testid="financial-overview-info">Who can see this?<i
                        class="fas fa-question-mark fa fa-question-circle ms-1"></i></span>
                  </div>
                </div>
                <div class="py-3 card-body">
                  <ul class="list-unstyled d-flex justify-content-around">
                    <li class="undefined py-1 px-4 d-flex flex-column align-items-center">
                      <div class="fw-bold text-dark">Trust Account Balance</div>
                      <div class="h2 m-0 fw-bold">$0.00</div>
                    </li>
                    <li class="text-success py-1 px-4 d-flex flex-column align-items-center">
                      <div class="fw-bold text-dark">Invoice Paid Month to Date</div>
                      <div class="h2 m-0 fw-bold">$0.00</div>
                    </li>
                    <li class="text-danger py-1 px-4 d-flex flex-column align-items-center">
                      <div class="fw-bold text-dark">Overdue Invoice Total</div>
                      <div class="h2 m-0 fw-bold">$0.00</div>
                    </li>
                    <li class="text-muted py-1 px-4 d-flex flex-column align-items-center">
                      <div class="fw-bold text-dark">Unsent Invoice Total</div>
                      <div class="h2 m-0 fw-bold">$0.00</div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="py-2 row ">
            <div class="col-6">
              <div class="h-100 card">
                <div class="card-header">
                  <div class="h5 fw-bold card-title"><a href="/insights/court_cases">Open Cases</a></div>
                </div>
                <div class="mb-3 card-body">
                  <div class="d-flex justify-content-center align-items-center">
                    <ul class="w-100 list-unstyled">
                      <li><span class="visually-hidden">Open cases count</span><span class="fw-bold display-1">1</span>
                      </li>
                      <li class="d-flex justify-content-between border-bottom w-100 mx-1 py-2"><span>New Cases in last
                          30 days</span><span>0</span></li>
                      <li class="d-flex justify-content-between border-bottom w-100 mx-1 py-2"><span>Cases closed in
                          last 30 days</span><span>0</span></li>
                      <li class="d-flex justify-content-between border-bottom w-100 mx-1 py-2"><span>Changed stage in
                          last 30 days</span><span>0</span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="ps-0 col-6">
              <div class="w-100 h-100 card">
                <div class="card-header">
                  <div class="h5 fw-bold card-title"><a href="/insights/leads">Leads Over Time</a></div>
                </div>
                <div class="mt-3 ms-3">
                  <div class="mb-3" data-testid="leads-over-time-filters">
                    <div class="d-flex mb-0">
                      <div class="chart-filter d-flex leads-over-time-filters">
                        <div
                          class="Select practice-area-select d-inline-block w-auto me-2 is-clearable is-searchable Select--single">
                          <div class="Select-control"><span class="Select-multi-value-wrapper"
                              id="react-select-2--value">
                              <div class="Select-placeholder">All Practice Areas</div>
                              <div class="Select-input" style="display: inline-block;"><input
                                  id="leads-over-time-filters" aria-activedescendant="react-select-2--value"
                                  aria-expanded="false" aria-haspopup="false" aria-owns="" role="combobox" value=""
                                  style="box-sizing: content-box; width: 5px;">
                                <!-- <div
                                  style="position: absolute; top: 0px; left: 0px; visibility: hidden; height: 0px; overflow: scroll; white-space: pre; font-size: 13px; font-family: neue-haas-grotesk-text, &quot;Helvetica Neue&quot;, -apple-system, BlinkMacSystemFont, Roboto, Arial, sans-serif; font-weight: 400; font-style: normal; letter-spacing: normal; text-transform: none;">
                                </div> -->
                              </div>
                            </span><span class="Select-arrow-zone"><i aria-hidden="true"
                                class="fa-solid fa-caret-down"></i></span></div>
                        </div>
                      </div>
                      <div class="align-self-center"><span id="why-practice-area"><i
                            class="fas fa-question-circle ms-1"></i></span></div>
                    </div>
                  </div>
                </div>
                <div class="pb-2 d-flex flex-column card-body">
                  <div class="recharts-responsive-container leads-over-time" style="width: 99%; height: 200px;">
                    <div class="recharts-wrapper"
                      style="position: relative; cursor: default; width: 317px; height: 200px;"><svg
                        class="recharts-surface" width="317" height="200" viewBox="0 0 317 200" version="1.1">
                        <defs>
                          <clipPath id="recharts4-clip">
                            <rect x="50" y="0" height="170" width="267"></rect>
                          </clipPath>
                        </defs>
                        <g class="recharts-cartesian-grid">
                          <g class="recharts-cartesian-grid-horizontal">
                            <line stroke="#ccc" fill="none" x="50" y="0" width="267" height="170" x1="50" y1="170"
                              x2="317" y2="170"></line>
                            <line stroke="#ccc" fill="none" x="50" y="0" width="267" height="170" x1="50" y1="131.25"
                              x2="317" y2="131.25"></line>
                            <line stroke="#ccc" fill="none" x="50" y="0" width="267" height="170" x1="50" y1="92.5"
                              x2="317" y2="92.5"></line>
                            <line stroke="#ccc" fill="none" x="50" y="0" width="267" height="170" x1="50" y1="53.75"
                              x2="317" y2="53.75"></line>
                            <line stroke="#ccc" fill="none" x="50" y="0" width="267" height="170" x1="50" y1="15"
                              x2="317" y2="15"></line>
                            <line stroke="#ccc" fill="none" x="50" y="0" width="267" height="170" x1="50" y1="0"
                              x2="317" y2="0"></line>
                          </g>
                        </g>
                        <g class="recharts-layer recharts-cartesian-axis recharts-xAxis xAxis">
                          <g class="recharts-cartesian-axis-ticks">
                            <g class="recharts-layer recharts-cartesian-axis-tick"><text width="267" height="30"
                                x="94.72727272727272" y="178" stroke="none" fill="#666"
                                class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle">
                                <tspan x="94.72727272727272" dy="0.71em">Jan 2023</tspan>
                              </text></g>
                            <g class="recharts-layer recharts-cartesian-axis-tick"><text width="267" height="30"
                                x="153.9090909090909" y="178" stroke="none" fill="#666"
                                class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle">
                                <tspan x="153.9090909090909" dy="0.71em">Apr 2023</tspan>
                              </text></g>
                            <g class="recharts-layer recharts-cartesian-axis-tick"><text width="267" height="30"
                                x="213.0909090909091" y="178" stroke="none" fill="#666"
                                class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle">
                                <tspan x="213.0909090909091" dy="0.71em">Jul 2023</tspan>
                              </text></g>
                            <g class="recharts-layer recharts-cartesian-axis-tick"><text width="267" height="30"
                                x="289.171875" y="178" stroke="none" fill="#666"
                                class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle">
                                <tspan x="289.171875" dy="0.71em">Nov 2023</tspan>
                              </text></g>
                          </g>
                        </g>
                        <g class="recharts-layer recharts-cartesian-axis recharts-yAxis yAxis">
                          <g class="recharts-cartesian-axis-ticks">
                            <g class="recharts-layer recharts-cartesian-axis-tick"><text width="60" height="170" x="42"
                                y="170" stroke="none" fill="#666"
                                class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="end">
                                <tspan x="42" dy="0.355em">0</tspan>
                              </text></g>
                            <g class="recharts-layer recharts-cartesian-axis-tick"><text width="60" height="170" x="42"
                                y="131.25" stroke="none" fill="#666"
                                class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="end">
                                <tspan x="42" dy="0.355em">0.25</tspan>
                              </text></g>
                            <g class="recharts-layer recharts-cartesian-axis-tick"><text width="60" height="170" x="42"
                                y="92.5" stroke="none" fill="#666"
                                class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="end">
                                <tspan x="42" dy="0.355em">0.5</tspan>
                              </text></g>
                            <g class="recharts-layer recharts-cartesian-axis-tick"><text width="60" height="170" x="42"
                                y="53.75" stroke="none" fill="#666"
                                class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="end">
                                <tspan x="42" dy="0.355em">0.75</tspan>
                              </text></g>
                            <g class="recharts-layer recharts-cartesian-axis-tick"><text width="60" height="170" x="42"
                                y="15" stroke="none" fill="#666"
                                class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="end">
                                <tspan x="42" dy="0.355em">1</tspan>
                              </text></g>
                          </g>
                        </g>
                        <g class="recharts-layer recharts-line Converted">
                          <path stroke-width="3" stroke="#661051" fill="none" width="267" height="170"
                            class="recharts-curve recharts-line-curve"
                            d="M75,170L94.72727272727272,170L114.45454545454545,170L134.1818181818182,170L153.9090909090909,170L173.63636363636363,170L193.36363636363637,170L213.0909090909091,170L232.8181818181818,170L252.54545454545453,170L272.27272727272725,170L292,170"
                            style="cursor: default;"></path>
                        </g>
                        <g class="recharts-layer recharts-line Did Not Hire">
                          <path stroke-width="3" stroke="#33658A" fill="none" width="267" height="170"
                            class="recharts-curve recharts-line-curve"
                            d="M75,170L94.72727272727272,170L114.45454545454545,170L134.1818181818182,170L153.9090909090909,170L173.63636363636363,170L193.36363636363637,170L213.0909090909091,170L232.8181818181818,170L252.54545454545453,170L272.27272727272725,170L292,170"
                            style="cursor: default;"></path>
                        </g>
                        <g class="recharts-layer recharts-line Added">
                          <path stroke-width="3" stroke="#2F4759" fill="none" width="267" height="170"
                            class="recharts-curve recharts-line-curve"
                            d="M75,170L94.72727272727272,170L114.45454545454545,170L134.1818181818182,170L153.9090909090909,170L173.63636363636363,170L193.36363636363637,170L213.0909090909091,170L232.8181818181818,15L252.54545454545453,170L272.27272727272725,170L292,170"
                            style="cursor: default;"></path>
                        </g>
                      </svg>
                      <div
                        class="recharts-tooltip-wrapper recharts-tooltip-wrapper-right recharts-tooltip-wrapper-bottom"
                        style="pointer-events: none; visibility: hidden; position: absolute; top: 0px; transform: translate(50px, 10px);">
                        <div class="recharts-default-tooltip"
                          style="margin: 0px; padding: 10px; background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); white-space: nowrap;">
                          <p class="recharts-tooltip-label" style="margin: 0px 0px 5px;"></p>
                        </div>
                      </div>
                    </div>
                    <div style="position: absolute; width: 0px; height: 0px; visibility: hidden; display: none;"></div>
                  </div>
                  <div class="insights-legend d-flex flex-row mt-2 ps-3 flex-wrap" style="opacity: 1;">
                    <div class="d-flex flex-row pe-3 align-items-center leads-over-time-legend-item-0">
                      <div class="align-self-start mt-1 legend-box"
                        style="background-color: rgb(47, 71, 89); width: 16px; height: 16px;"></div>
                      <div class="ps-1 d-flex flex-column">
                        <h4 class="insights-legend-data fw-bold mb-0">1</h4><a href="/leads?status=active"
                          class="fw-light selenium-added-leads-legend-link">Added</a>
                      </div>
                    </div>
                    <div class="d-flex flex-row pe-3 align-items-center leads-over-time-legend-item-1">
                      <div class="align-self-start mt-1 legend-box"
                        style="background-color: rgb(51, 101, 138); width: 16px; height: 16px;"></div>
                      <div class="ps-1 d-flex flex-column">
                        <h4 class="insights-legend-data fw-bold mb-0">0</h4><a href="/leads?status=did_not_hire"
                          class="fw-light selenium-did not hire-leads-legend-link">Did Not Hire</a>
                      </div>
                    </div>
                    <div class="d-flex flex-row pe-3 align-items-center leads-over-time-legend-item-2">
                      <div class="align-self-start mt-1 legend-box"
                        style="background-color: rgb(102, 16, 81); width: 16px; height: 16px;"></div>
                      <div class="ps-1 d-flex flex-column">
                        <h4 class="insights-legend-data fw-bold mb-0">0</h4><a href="/leads?status=converted"
                          class="fw-light selenium-converted-leads-legend-link">Converted</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="activity-container" class="py-2" data-testid="recent-activity">
            <div class="dashboard-activity-container">
              <div class="card">
                <div class="card-title h5 fw-bold card-header">Recent Activity</div>
                <div class="activity-card-body card-body">
                  <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#" class="pendo-activity-feed nav-link active">All</a></li>
                    <li class="nav-item"><a href="#" class="pendo-activity-feed nav-link">Invoices</a></li>
                    <li class="nav-item"><a href="#" class="pendo-activity-feed nav-link">Events</a></li>
                    <li class="nav-item"><a href="#" class="pendo-activity-feed nav-link">Documents</a></li>
                    <li class="nav-item"><a href="#" class="pendo-activity-feed nav-link">Tasks</a></li>
                    <li class="nav-item"><a href="#" class="pendo-activity-feed nav-link">Deleted</a></li>
                  </ul>
                  <div class="notifications_holder">
                    <div class="notifications-page card-body p-0">
                      <div class="no-items notification-activity-item p-3">No recent activity available.</div>
                    </div>
                  </div>
                  <div class="pt-3"><a href="/notifications" class="pendo-view-all-activity">View all activity</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="ps-0 col-4">
          <div>
            <div class="my-2 card">
              <div class="card-header">
                <div class="h5 fw-bold card-title"><a href="/tasks">My Tasks</a></div>
              </div>
              <div class="py-3 card-body">
                <ul class="d-flex justify-content-around list-unstyled">
                  <li class="py-1 px-4 d-flex flex-column align-items-center">
                    <div class="fw-bold text-nowrap">Due Today</div>
                    <div class="h2 m-0 fw-bold text-warning">0</div>
                  </li>
                  <li class="py-1 px-4 d-flex flex-column align-items-center">
                    <div class="fw-bold text-nowrap">Overdue</div>
                    <div class="h2 m-0 fw-bold text-danger">4</div>
                  </li>
                  <li class="py-1 px-4 d-flex flex-column align-items-center">
                    <div class="fw-bold text-nowrap">Incomplete</div>
                    <div class="h2 m-0 fw-bold text-muted">4</div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div>
            <div class="my-3 card">
              <div class="card-header">
                <div class="h5 fw-bold card-title"><a href="/events">Today's Events</a></div>
              </div>
              <div class="card-body">
                <div style="height: 25rem;">
                  <div class="h-100">
                    <div class="day-view flex-grow-1 rbc-calendar">
                      <div class="rbc-time-view rbc-time-view-resources">
                        <div class="rbc-time-header rbc-overflowing" style="margin-right: 0px;">
                          <div class="rbc-label rbc-time-header-gutter"
                            style="width: 66.6562px; min-width: 66.6562px; max-width: 66.6562px;"></div>
                          <div class="rbc-time-header-content">
                            <div class="rbc-row rbc-row-resource">
                              <div class="rbc-header"></div>
                            </div>
                            <div class="rbc-row rbc-time-header-cell rbc-time-header-cell-single-day">
                              <div class="rbc-header rbc-today"><a href="#"><span>Sat, Nov 11</span></a></div>
                            </div>
                            <div class="rbc-allday-cell">
                              <div class="rbc-row-bg">
                                <div class="rbc-day-bg rbc-today"></div>
                              </div>
                              <div class="rbc-row-content">
                                <div class="rbc-row"></div>
                                <div class="rbc-row"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="rbc-time-content">
                          <div class="rbc-time-gutter rbc-time-column">
                            <div class="rbc-timeslot-group">
                              
                            <div class="rbc-events-container"></div>
                            <div class="rbc-current-time-indicator" style="top: 33.3333%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

 
          <div>

          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</body>

</html>