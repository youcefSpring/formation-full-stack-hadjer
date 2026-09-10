<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>@yield('title', 'Dashboard') | Admin-Hadjer</title>

  <link rel="stylesheet" href="{{ asset('template_admin/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template_admin/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('template_admin/assets/css/style.css') }}">
  @stack('styles')
</head>
