package net.freelancertech.gdg.demo.app;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.messaging.FirebaseMessaging;

public class MainActivity extends AppCompatActivity {

    private  TextView notification_textview;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Intent intent = getIntent();
        String message = "Hello World!";
        if ( intent != null && intent.getStringExtra("message") != null){

             message= intent.getStringExtra("message");
        }

        notification_textview = (TextView) findViewById(R.id.notification_textview);
        notification_textview.setText(message);

        FirebaseMessaging.getInstance().subscribeToTopic("demogdg");
        FirebaseInstanceId.getInstance().getToken();
    }
}
