import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ToastController } from '@ionic/angular';
import { PostProvider } from '../../providers/post-provider';

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page implements OnInit {
  nama: string = '';
  tempat_lahir: string = '';
  tanggal_lahir: string = '';
  alamat: string = '';
  jenis_kelamin: string = '';
  agama: string = '';
  pendidikan_terakhir: string = '';
  kegiatan_sekarang: string = '';
  nomor_telepon: string = '';
  email: string = '';
  status_koneksi: string = '';
  atas_nama: string = '';
  nama_koneksi: string = '';

  constructor(
    private router: Router,
    public toastController: ToastController,
    private postPvdr: PostProvider
  ) { }

  ngOnInit() {
  }

  async addRegister() {
    if (this.nama == '') {
      const toast = await this.toastController.create({
        message: 'Nama lengkap harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.tempat_lahir == '') {
      const toast = await this.toastController.create({
        message: 'Tempat lahir harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.tanggal_lahir == '') {
      const toast = await this.toastController.create({
        message: 'Tanggal lahir harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.alamat == '') {
      const toast = await this.toastController.create({
        message: 'Alamat harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.jenis_kelamin == '') {
      const toast = await this.toastController.create({
        message: 'Jenis kelamin harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.agama == '') {
      const toast = await this.toastController.create({
        message: 'Agama harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.pendidikan_terakhir == '') {
      const toast = await this.toastController.create({
        message: 'Pendidikan terakhir harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.kegiatan_sekarang == '') {
      const toast = await this.toastController.create({
        message: 'Kegiatan sekarang harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.nomor_telepon == '') {
      const toast = await this.toastController.create({
        message: 'Nomor telepon harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.email == '') {
      const toast = await this.toastController.create({
        message: 'Email harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.status_koneksi == '') {
      const toast = await this.toastController.create({
        message: 'Status koneksi harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.atas_nama == '') {
      const toast = await this.toastController.create({
        message: 'Atas nama harus di isi',
        duration: 2000
      });
      toast.present();
    } else if (this.nama_koneksi == '') {
      const toast = await this.toastController.create({
        message: 'Nama koneksi harus di isi',
        duration: 2000
      });
      toast.present();
    } else {
      let body = {
        nama: this.nama,
        tempat_lahir: this.tempat_lahir,
        tanggal_lahir: this.tanggal_lahir,
        alamat: this.alamat,
        jenis_kelamin: this.jenis_kelamin,
        agama: this.agama,
        pendidikan_terakhir: this.pendidikan_terakhir,
        kegiatan_sekarang: this.kegiatan_sekarang,
        nomor_telepon: this.nomor_telepon,
        email: this.email,
        status_koneksi: this.status_koneksi,
        atas_nama: this.atas_nama,
        nama_koneksi: this.nama_koneksi,
        aksi: 'addRegister'
      };

      this.postPvdr.postData(body, 'action.php').subscribe(async data => {
        var alertpesan = data.msg;
        if (data.success) {
          this.router.navigate(['/tab3']);
          const toast = await this.toastController.create({
            message: 'Selamat! Anda sudah berhasil bergabung menjadi koneksi kami.',
            duration: 2000
          });
          toast.present();
        } else {
          const toast = await this.toastController.create({
            message: alertpesan,
            duration: 2000
          });
          toast.present();
        }
      });
    }
  }
}