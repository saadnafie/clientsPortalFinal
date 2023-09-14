<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        $table->foreign('role_id')->references('id')->on('user_roles')->onUpdate('cascade');
      });

      Schema::table('applications', function (Blueprint $table) {
       $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
     });

     Schema::table('applications', function (Blueprint $table) {
      $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
    });

       Schema::table('applications', function (Blueprint $table) {
        $table->foreign('status_id')->references('id')->on('application_statuses')->onUpdate('cascade');
      });

      Schema::table('applications', function (Blueprint $table) {
        $table->foreign('process_id')->references('id')->on('application_process_statuses')->onUpdate('cascade');
      });

      Schema::table('applications', function (Blueprint $table) {
       $table->foreign('profession_id')->references('id')->on('professions')->onUpdate('cascade');
     });

      Schema::table('application_details', function (Blueprint $table) {
       $table->foreign('application_id')->references('id')->on('applications')->onUpdate('cascade')->onDelete('cascade');
     });

     Schema::table('application_licenses', function (Blueprint $table) {
      $table->foreign('application_id')->references('id')->on('applications')->onUpdate('cascade')->onDelete('cascade');
    });

    Schema::table('invoices', function (Blueprint $table) {
     $table->foreign('application_id')->references('id')->on('applications')->onUpdate('cascade');
   });

     Schema::table('application_details', function (Blueprint $table) {
      $table->foreign('credential_id')->references('id')->on('credential_classifications')->onUpdate('cascade');
     });


       Schema::table('sub_professions', function (Blueprint $table) {
          $table->foreign('profession_id')->references('id')->on('professions')->onUpdate('cascade');
        });

        Schema::table('profession_countries', function (Blueprint $table) {
         $table->foreign('profession_id')->references('id')->on('professions')->onUpdate('cascade');
       });

       Schema::table('profession_countries', function (Blueprint $table) {
        $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
      });

      Schema::table('profession_countries', function (Blueprint $table) {
        $table->foreign('package_type_id')->references('id')->on('package_types')->onUpdate('cascade');
      });

      Schema::table('profession_rules', function (Blueprint $table) {
       $table->foreign('profession_country_id')->references('id')->on('profession_countries')->onUpdate('cascade');
     });

       Schema::table('profession_rules', function (Blueprint $table) {
        $table->foreign('credential_id')->references('id')->on('credential_classifications')->onUpdate('cascade');
      });

      Schema::table('credential_form_fields', function (Blueprint $table) {
       $table->foreign('credential_id')->references('id')->on('credential_classifications')->onUpdate('cascade');
     });

     Schema::table('credential_form_fields', function (Blueprint $table) {
      $table->foreign('form_field_id')->references('id')->on('form_fields')->onUpdate('cascade');
     });

     Schema::table('credential_form_field_rules', function (Blueprint $table) {
      $table->foreign('credential_form_field_id')->references('id')->on('credential_form_fields')->onUpdate('cascade');
     });

     Schema::table('credential_form_field_rules', function (Blueprint $table) {
      $table->foreign('rule_id')->references('id')->on('field_rules')->onUpdate('cascade');
     });

     Schema::table('form_fields', function (Blueprint $table) {
       $table->foreign('type_id')->references('id')->on('field_types')->onUpdate('cascade');
     });

     Schema::table('dropdown_options', function (Blueprint $table) {
      $table->foreign('form_field_id')->references('id')->on('form_fields')->onUpdate('cascade');
     });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
