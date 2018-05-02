<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> {{ title }}

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-primary btn-sm" role="button" @click="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <vue-form class="form-horizontal form-validation" :state="state" @submit.prevent="onSubmit">
        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="sekolah_id">Sekolah</label>
              <v-select name="sekolah_id" v-model="model.sekolah" :options="sekolah" placeholder="Sekolah" required autofocus></v-select>

              <field-messages name="sekolah_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Sekolah is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="program_keahlian_id">Program Keahlian</label>
              <v-select name="program_keahlian_id" v-model="model.program_keahlian" :options="program_keahlian" placeholder="Program Keahlian" required></v-select>

              <field-messages name="program_keahlian_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Program Keahlian is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="kuota_siswa">Kuota Siswa</label>
              <input type="text" class="form-control" name="kuota_siswa" v-model="model.kuota_siswa" placeholder="Kuota Siswa" required>

              <field-messages name="kuota_siswa" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Kuota Siswa is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <!-- <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="keterangan">Keterangan</label>
              <input type="text" class="form-control" name="keterangan" v-model="model.keterangan" placeholder="Keterangan" required>

              <field-messages name="keterangan" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Keterangan is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div> -->

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="user_id">Username</label>
              <v-select name="user_id" v-model="model.user" :options="user" placeholder="Username" required></v-select>

              <field-messages name="user_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">User is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary" @click="reset">Reset</button>
          </div>
        </div>
      </vue-form>
    </div>
  </div>
</template>

<script>
import swal from 'sweetalert2';

export default {
  data() {
    return {
      state: {},
      title: 'Add Prodi Sekolah',
      model: {
        sekolah_id          : '',
        program_keahlian_id : '',
        kuota_siswa         : '',
        // keterangan          : '',
        user_id             : '',
        created_at          : '',
        updated_at          : '',

        sekolah             : '',
        program_keahlian    : '',
        user                : '',
      },
      sekolah           : [],
      program_keahlian  : [],
      user              : [],
    }
  },
  mounted(){
    let app = this;

    axios.get('api/prodi-sekolah/create')
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.program_keahlian = response.data.program_keahlians;
          this.model.user       = response.data.current_user;

          if(response.data.user_special == true){
            this.user = response.data.users;
          }else{
            this.user.push(response.data.users);
          }
        } else {
          swal(
            'Failed',
            'Oops... '+response.data.message,
            'error'
          );

          app.back();
        }
      })
      .catch(function(response) {
        swal(
          'Not Found',
          'Oops... Your page is not found.',
          'error'
        );

        app.back();
      });

    axios.get('api/sekolah/get')
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.sekolah = response.data.sekolahs;
        } else {
          swal(
            'Failed',
            'Oops... '+response.data.message,
            'error'
          );

          app.back();
        }
      })
      .catch(function(response) {
        swal(
          'Not Found',
          'Oops... Your page is not found.',
          'error'
        );

        app.back();
      });
  },
  methods: {
    onSubmit: function() {
      let app = this;

      if (this.state.$invalid) {
        return;
      } else {
        axios.post('api/prodi-sekolah', {
            sekolah_id          : this.model.sekolah.id,
            program_keahlian_id : this.model.program_keahlian.id,
            kuota_siswa         : this.model.kuota_siswa,
            // keterangan          : this.model.keterangan,
            user_id             : this.model.user.id,
          })
          .then(response => {
            if (response.data.status == true) {
              if(response.data.error == false){
                swal(
                  'Created',
                  'Yeah!!! Your data has been created.',
                  'success'
                );

                app.back();
              }else{
                swal(
                  'Failed',
                  'Oops... '+response.data.message,
                  'error'
                );
              }
            } else {
              swal(
                'Failed',
                'Oops... '+response.data.message,
                'error'
              );

              app.back();
            }
          })
          .catch(function(response) {
            swal(
              'Not Found',
              'Oops... Your page is not found.',
              'error'
            );

            app.back();
          });
      }
    },
    reset() {
      this.model = {
        sekolah_id          : '',
        program_keahlian_id : '',
        kuota_siswa         : '',
        // keterangan          : '',
        user_id             : '',
        created_at          : '',
        updated_at          : '',

        sekolah             : '',
        program_keahlian    : '',
        user                : '',
      };
    },
    back() {
      window.location = '#/admin/prodi-sekolah';
    }
  }
}
</script>
