using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;
using System.Windows.Forms;

namespace gru1._2
{
    class gagnagrunnur
    {
        private string server;
        private string database;
        private string uid;
        private string password;
        string fyrirspurn = null;
        string tengistrengur;
        MySqlConnection sqltenging;
        MySqlCommand nySQLskipun;
        MySqlDataReader sqllesari = null;

        //Initialize values
        public void Tenging()
        {
            server = "tsuts.tskoli.is";
            database = "0901972759_lokavrkefni_gru1";
            uid = "0901972759";
            password = "mypassword";
            tengistrengur = "SERVER=" + server + ";" + "DATABASE=" + database + ";" + "UID=" + uid + ";" + "PASSWORD=" + password + ";";

            sqltenging = new MySqlConnection(tengistrengur);
        }
        public bool OpenConnection()
        {
            try
            {
                sqltenging.Open();
                return true;
            }
            catch (MySqlException ex)
            {
                //2 most common errors numbers when connecting are as folows
                //0: Cannot connect to server
                //1045: Invalid username or password
                switch (ex.Number)
                {
                    case 0:
                        MessageBox.Show("Cannot connect to server. Contact administrator");
                        break;

                    case 1045:
                        MessageBox.Show("Invalid username or password, please try again.");
                        break;
                }
                return false;

            }
        }

        //Close connection
        private bool CloseConnection()
        {
            try
            {
                sqltenging.Close();
                return true;
            }//lokar try
            catch (MySqlException ex)
            {
                MessageBox.Show(ex.Message);
                return false;
            }//lokar catch
        }

        //insert statement
        public void Insert(string user_id, string nafn, string Simi, string Lykilord, string Netfang )//opnar public void Insert
        {
            fyrirspurn = "INSERT INTO user(user_id, nafn, Simi, Lykilord, Netfang) VALUES('" + user_id + "', '" + nafn + "', '" + Simi + "', '" + Lykilord + "', '" + Netfang + "')";//insetar inní phpmyadmin

            try//notar try utan um "viðkvæman kóða"
            {


                //open connection
                if (this.OpenConnection() == true)
                {
                    //create command and assign the query and connection from the constructor
                    MySqlCommand cmd = new MySqlCommand(fyrirspurn, sqltenging);

                    //Execute command
                    cmd.ExecuteNonQuery();

                    //clsoe connection 
                    this.CloseConnection();
                }//lokar if

            }//lokar try
            catch (Exception ex)//keyrir ef að kóðinn í try virkar ekki
            {
                MessageBox.Show(ex.Message);
                throw;
            }//lokar catch
        }//lokar public void Insert
        //Select statement
        public List<string>[] Select()//byr til select
        {
            string query = "SELECT * FROM user";

            //create a list to store the result
            List<string>[] list = new List<string>[4];
            list[0] = new List<string>();
            list[1] = new List<string>();
            list[2] = new List<string>();
            list[3] = new List<string>();
            list[4] = new List<string>();

            //Open connection
            if (this.OpenConnection() == true)
            {
                //Create Command
                MySqlCommand cmd = new MySqlCommand(query, sqltenging);
                //create data reader and Execute the command
                MySqlDataReader dataReader = cmd.ExecuteReader();

                //Read the data and store them in the list
                while (dataReader.Read())
                {
                    list[0].Add(dataReader["user_id"] + "");
                    list[1].Add(dataReader["nafn"] + "");
                    list[2].Add(dataReader["Simi"] + "");
                    list[3].Add(dataReader["lord"] + "");
                    list[3].Add(dataReader["Netfang"] + "");
                }

                //close data reader
                dataReader.Close();

                //close connection
                this.sqltenging.Close();

                //return the list to be displayed
                return list;

            }//endir if
            else
            {
                return list;
            }//endir else
        }//lokar Select

        public void Uppfaera(string user_id, string nafn, string Simi, string Lykilord, string Netfang)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "UPDATE user SET user_id ='" + user_id + "', nafn= '" + nafn + "' ,Simi='" + Simi + "' ,Lykilord='" + Lykilord + "',Netfang='" + Netfang + "' WHERE user_id='" + user_id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }
        }

        public void Eyda(string user_id)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "DELETE FROM user WHERE user_id='" + user_id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }
        }


        public List<string> LesaSQLToflu()//herna er taflan sem þarf að breyta yfir i listview
        {
            List<string> Faerslur = new List<string>();
            string lina = null;
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT user_id, nafn, Simi, Lykilord, Netfang FROM user";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        lina += (sqllesari.GetValue(i).ToString()) + " - ";
                    }
                    Faerslur.Add(lina);
                    lina = null;
                }
                CloseConnection();
                return Faerslur;
            }
            return Faerslur;
        }

        public string[] FinnaAkvedinOgSkila(string user_id)
        {
            string[] gogn = new string[5];
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT user_id,nafn,Simi,Lykilord,Netfang FROM user WHERE user_id='" + user_id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    gogn[0] = sqllesari.GetValue(0).ToString();
                    gogn[1] = sqllesari.GetValue(1).ToString();
                    gogn[2] = sqllesari.GetValue(2).ToString();
                    gogn[3] = sqllesari.GetValue(3).ToString();
                    gogn[3] = sqllesari.GetValue(4).ToString();
                }
                sqllesari.Close();
                CloseConnection();
                return gogn;
            }
            return gogn;
        }

        public string FinnaEinstakling(string user_id)
        {
            string lina = null;
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT user_id,nafn,Simi,Lykilord,Netfang FROM user WHERE user_id='" + user_id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        lina += (sqllesari.GetValue(i).ToString()) + " - ";
                    }
                }
                sqltenging.Close();
            }
            return lina;
        }
        public void checkLogin(string user_id, string Lykilord)
        {
            if (OpenConnection())
            {
                fyrirspurn = "SELECT user_id FROM user WHERE user_id = '" +user_id +"' AND Lykilord = '" + Lykilord +"'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                int teljari = 0;
                while (sqllesari.Read())
                {
                    teljari += 1;
                }

                if (teljari == 1)
                {
                    MessageBox.Show("Success");
                    
                }

                else if(teljari > 0)
                {
                    MessageBox.Show("damn");
                }
                 CloseConnection();
                    
                
            }
            CloseConnection();
           
        }

       /* public List<string> YngriEn40()
        {
            List<string> Faerslur = new List<string>();
            string lina = null;
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT medlimaNr, nafn, heimilisfang, postnumer, aldur FROM medlimir WHERE aldur < 40";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        lina += (sqllesari.GetValue(i).ToString()) + " - ";
                    }
                    Faerslur.Add(lina);
                    lina = null;
                }
                CloseConnection();
                return Faerslur;
            }
            return Faerslur;
        }

        public List<string> SynaNofn()
        {
            List<string> Faerslur = new List<string>();
            string lina = null;
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT nafn FROM medlimir";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        lina += (sqllesari.GetValue(i).ToString()) + " - ";
                    }
                    Faerslur.Add(lina);
                    lina = null;
                }
                CloseConnection();
                return Faerslur;
            }
            return Faerslur;
        }

        public List<string> Medalaldur()
        {
            List<string> Faerslur = new List<string>();
            string lina = null;
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT AVG(aldur) AS aldur FROM medlimir";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        lina += (sqllesari.GetValue(i).ToString()) + " - ";
                    }
                    Faerslur.Add(lina);
                    lina = null;
                }
                CloseConnection();
                return Faerslur;
            }
            return Faerslur;
        }*/

    }







    }









