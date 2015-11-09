namespace gru1._2
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.btlogin = new System.Windows.Forms.Button();
            this.kennitala = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.tbloginkennitala = new System.Windows.Forms.TextBox();
            this.tbloginpassword = new System.Windows.Forms.TextBox();
            this.SuspendLayout();
            // 
            // btlogin
            // 
            this.btlogin.Location = new System.Drawing.Point(115, 234);
            this.btlogin.Name = "btlogin";
            this.btlogin.Size = new System.Drawing.Size(143, 33);
            this.btlogin.TabIndex = 0;
            this.btlogin.Text = "Login";
            this.btlogin.UseVisualStyleBackColor = true;
            this.btlogin.Click += new System.EventHandler(this.btlogin_Click);
            // 
            // kennitala
            // 
            this.kennitala.AutoSize = true;
            this.kennitala.Location = new System.Drawing.Point(60, 90);
            this.kennitala.Name = "kennitala";
            this.kennitala.Size = new System.Drawing.Size(50, 13);
            this.kennitala.TabIndex = 1;
            this.kennitala.Text = "kennitala";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(60, 143);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(53, 13);
            this.label2.TabIndex = 2;
            this.label2.Text = "Password";
            // 
            // tbloginkennitala
            // 
            this.tbloginkennitala.Location = new System.Drawing.Point(144, 87);
            this.tbloginkennitala.Name = "tbloginkennitala";
            this.tbloginkennitala.Size = new System.Drawing.Size(100, 20);
            this.tbloginkennitala.TabIndex = 3;
            // 
            // tbloginpassword
            // 
            this.tbloginpassword.Location = new System.Drawing.Point(144, 140);
            this.tbloginpassword.Name = "tbloginpassword";
            this.tbloginpassword.Size = new System.Drawing.Size(100, 20);
            this.tbloginpassword.TabIndex = 4;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(394, 307);
            this.Controls.Add(this.tbloginpassword);
            this.Controls.Add(this.tbloginkennitala);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.kennitala);
            this.Controls.Add(this.btlogin);
            this.Name = "Form1";
            this.Text = "Innskraning";

            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button btlogin;
        private System.Windows.Forms.Label kennitala;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox tbloginkennitala;
        private System.Windows.Forms.TextBox tbloginpassword;
    }
}

