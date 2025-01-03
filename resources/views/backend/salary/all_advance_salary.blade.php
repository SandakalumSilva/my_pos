@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('add.advance.salary') }}"
                                    class="btn btn-warning rounded-pill waves-effect waves-light">
                                    Add Advance Salary
                                </a>
                            </ol>
                        </div>
                        <h4 class="page-title">All Advance Salary</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>Salary</th>
                                        <th>Advance Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salaries as $key => $salary)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> <img src="{{ asset($salary->employee->image) }}"
                                                    style="width: 50px; height:40px;">
                                            </td>
                                            <td>{{ $salary['employee']['name'] }}</td>
                                            <td>{{ $salary->month }}</td>
                                            <td>{{ $salary['employee']['salary'] }}</td>
                                            <td>{{ $salary->advance_salary }}</td>
                                            <td>
                                                <a href="{{ route('edit.advance.salary', $salary->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                                                <a href="{{ route('delete.advance.salary', $salary->id) }}"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light"
                                                    id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->




        </div> <!-- container -->

    </div> <!-- content -->
@endsection
