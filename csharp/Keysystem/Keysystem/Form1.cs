using System;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Keysystem
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            using (var client = new WebClient())
            {

                var values = new NameValueCollection();
                values["Request"] = "Checkfortoken";
                values["token"] = textBox1.Text;
                var response = client.UploadValues("http://127.0.0.1/csharphandler.php", values);

                var responseString = Encoding.Default.GetString(response);
                label1.Text = responseString;
                if (responseString == "Exists")
                {
                    Form2 obj = new Form2();
                    obj.Show();
                    this.Hide();
                }
            }

        }
    }
}
