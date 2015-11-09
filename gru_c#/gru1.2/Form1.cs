using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Security.Cryptography;
using System.Text;


namespace gru1._2
{
    public partial class Form1 : Form
    {
        gagnagrunnur gagnagrunnur = new gagnagrunnur();

        /*string stff = "DATA TO BE HASHED";*/
        
        public Form1()
        {
            InitializeComponent();
            try
            {
                gagnagrunnur.OpenConnection();
            }
            catch (Exception)
            {
                
                
            }
            //Kallað í fallið CreatePasswordHash og sett inn eitthvað gildi til að hassa, svona til þess að prófa.
            string the_sha512_hash = CreatePasswordHash("123456789");
            MessageBox.Show(the_sha512_hash);
        }
        /*Kóðinn í CreatePasswordHash er tekinn af http://stackoverflow.com/questions/12592036/taking-a-c-sharp-sha512-hash-and-compare-it-in-php
         og aðlagaður*/
        public static string CreatePasswordHash(string password)
        {
            string Pwd = password;
            SHA512 sha512 = new System.Security.Cryptography.SHA512Managed();//Nær í afrit af klasanum SHA512Managed til að við getum hashað

            byte[] sha512Bytes = System.Text.Encoding.UTF8.GetBytes(Pwd);//Þarna fáum við út byte-in og encodum þau í UTF8 og geymum
            //þessi byte í byte array.

            byte[] cryString = sha512.ComputeHash(sha512Bytes);//Hér er hvert og eitt hash byte reiknað út

            string hashedPwd = null;

            //Svo bara lúppum við í gegnum cryString sem inniheldur hashana. Við setjum þá saman í streng með þessari lúppu:
            for (int i = 0; i < cryString.Length; i++)
            {
                hashedPwd += cryString[i].ToString();
            }

            return hashedPwd;
        }








        private void btlogin_Click(object sender, EventArgs e)
        {
            string user_id = tbloginkennitala.Text;
            string Lykilord = tbloginpassword.Text;
            
            
            try
            {
                gagnagrunnur.checkLogin(user_id, Lykilord);
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
            }
           
                this.Hide();
                brbumsjon brbumsjon = new brbumsjon();
                brbumsjon.Show();
            


        }

        
    }
}
