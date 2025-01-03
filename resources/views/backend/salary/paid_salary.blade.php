@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Paid Salary</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Paid Salary</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('employe.salary.store') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $paySalary->id }}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Paid Salary</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Name</label>
                                                <strong style="color: #fff;">{{ $paySalary->name }}</strong>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Salary Month</label>
                                                <strong style="color: #fff;">{{ date('F', strtotime('-1 month')) }}</strong>
                                                <input type="hidden" name="month"
                                                    value="{{ date('F', strtotime('-1 month')) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Salary</label>
                                                <strong style="color: #fff;">{{ $paySalary->salary }}</strong>
                                                <input type="hidden" name="paid_amount" value="{{ $paySalary->salary }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Advance Salary</label>
                                                <strong style="color: #fff;">
                                                    @if (isset($paySalary['advance']['advance_salary']))
                                                        {{ number_format($paySalary['advance']['advance_salary'], 2) }}
                                                    @else
                                                        <p>No Advance Salary</p>
                                                    @endif
                                                </strong>
                                                <input type="hidden" name="advance_salary"
                                                    value="{{ isset($paySalary['advance']['advance_salary']) ? number_format($paySalary['advance']['advance_salary'], 2) : '-' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Due Salary</label>
                                                <strong style="color: #fff;">
                                                    @if (isset($paySalary['advance']['advance_salary']))
                                                        {{ number_format($paySalary->salary - $paySalary['advance']['advance_salary'], 2) }}
                                                    @else
                                                        {{ number_format($paySalary->salary, 2) }}
                                                    @endif
                                                </strong>
                                                <input type="hidden" name="due_salary"
                                                    value="{{ isset($paySalary['advance']['advance_salary']) ? number_format($paySalary->salary - $paySalary['advance']['advance_salary'], 2) : number_format($paySalary->salary, 2) }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i>Paid Salary</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->

                            <!-- end tab-content -->
                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->
    </div>
@endsection
