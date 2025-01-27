package com.example.Varsani.Clients.Adapters;

import android.app.ProgressDialog;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import com.example.Varsani.Clients.Models.OrderItemModal;
import com.example.Varsani.Clients.Models.ProductModal;
import com.example.Varsani.R;

import java.util.List;

public class AdapterInvoiceItems extends RecyclerView.Adapter<RecyclerView.ViewHolder> {

    private List<OrderItemModal> items;

    private Context ctx;
    ProgressDialog progressDialog;
    private OnItemClickListener mOnItemClickListener;
    private OnMoreButtonClickListener onMoreButtonClickListener;

    //


    private String orderID = "";

    public static final String TAG = "Orders adapter";

    public void setOnItemClickListener(final OnItemClickListener mItemClickListener) {
        this.mOnItemClickListener = mItemClickListener;
    }

    public void setOnMoreButtonClickListener(final OnMoreButtonClickListener onMoreButtonClickListener) {
        this.onMoreButtonClickListener = onMoreButtonClickListener;
    }

    public AdapterInvoiceItems(Context context, List<OrderItemModal> items) {
        this.items = items;
        ctx = context;
    }

    public class OriginalViewHolder extends RecyclerView.ViewHolder {

        public TextView txv_itemName, txv_price,txv_quantity;
        public TextView txv_subTotal;


        public OriginalViewHolder(View v) {
            super(v);

            txv_itemName =v.findViewById(R.id.txv_itemName);
            txv_price =v.findViewById(R.id.txv_price);
            txv_quantity = v.findViewById(R.id.txv_quantity);
            txv_subTotal = v.findViewById(R.id.txv_subtotal);
        }
    }

    @Override
    public RecyclerView.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        RecyclerView.ViewHolder vh;
        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.lv_invoiceitems, parent, false);
        vh = new OriginalViewHolder(v);
        return vh;
    }

    // Replace the contents of a view (invoked by the layout manager)
    @Override
    public void onBindViewHolder(RecyclerView.ViewHolder holder, final int position) {
        if (holder instanceof OriginalViewHolder) {
            final OriginalViewHolder view = (OriginalViewHolder) holder;

            final OrderItemModal oi= items.get(position);

            view.txv_itemName.setText( oi.getItemName());
            //view.txv_price.setText("KES "+ oi.getItemPrice());
            //view.txv_quantity.setText(oi.getQuantity());
            //view.txv_subTotal.setText(oi.getSubTotal());

        }
    }


    @Override
    public int getItemCount() {
        return items.size();
    }

    public interface OnItemClickListener {
        void onItemClick(View view, ProductModal obj, int pos);
    }

    public interface OnMoreButtonClickListener {
        void onItemClick(View view, ProductModal obj, MenuItem item);
    }



}